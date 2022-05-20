var application = new Vue({
    el:'#app',
    data:{
        products:[],
        bag: [],
        sum: 0,
        minPrice: 500000,
        maxPrice: 0,
        sortedByPrice: false,
        sortedByName: false,
        deleteProductsDisabled: true
    },

    methods:{
        mounted:function(){
            let self = this;
            axios
            .post('action.php', {action:'fetchall'})
            .then(function(response){
            application.products = response.data; 
            self.getMinAndMaxPrice(); 
            });
        }, 

        sortPrice() {
            let self = this;
            self.products.sort((a, b) => { 
                if (self.sortedByPrice) {
                    return a.price - b.price
                    
                } else {
                    return b.price - a.price
                }
            })
        },
        
        sortName() {
            let self = this;
            self.products.sort((a, b) => { 
                if (self.sortedByName) {
                    return b.name.toLowerCase() < a.name.toLowerCase() ? 1 : -1;
                } else {
                    return b.name.toLowerCase() > a.name.toLowerCase() ? 1 : -1;
                }
            })
        },

        getMinAndMaxPrice: function() {
            application.products.map(a => {
                application.minPrice = Math.min(a.price, application.minPrice);
                application.maxPrice = Math.max(a.price, application.maxPrice);
            })
        },
        
        addToBag: function(id){
            let self = this;
            let founded = self.bag.find(product => product.id == id)
            if(!founded){
                self.bag.push({id: id, quantity: 1, name: self.products.find(a => a.id == id).name});
            }
            else{
                founded.quantity++;
            }
            self.sum = 0;

            for(var productInBag of self.bag){
                //console.log(productInBag);
                let foundedProduct = self.products.find(prod => prod.id == productInBag.id);
                self.sum += foundedProduct.price * productInBag.quantity;
            }
            //console.log(this.bag);
        },

        deleteFromBag: function(id){
            let self = this;
            let founded = self.bag.find(product => product.id == id)
            if(!founded){
                self.bag.pop({id: id, quantity: 1, name: self.products.find(a => a.id == id).name});
            }            
            else{
                founded.quantity--;                              
            }
            
            if (founded.quantity == 0) {                
                self.bag = self.bag.filter(a => a.id != founded.id);
            }     
                            
            for(var productInBag of self.bag){
                //console.log(productInBag);
                let foundedProduct = self.products.find(prod => prod.id == productInBag.id);
                self.sum -= foundedProduct.price;
            }
            self.sum = 0;
            for(var productInBag of self.bag){
                //console.log(productInBag);
                let foundedProduct = self.products.find(prod => prod.id == productInBag.id);
                self.sum += foundedProduct.price * productInBag.quantity;
            }
            
            if (founded.quantity < 0) {
                founded.quantity = 0;
            }
            
            if (self.sum < 0){
                self.sum = 0;
            }
            //console.log(this.bag);
            
        },
    },

        created:function(){
            this.mounted();
        },

        computed: {
            filteredProducts: function() {
                let self = this;
                return self.products
                    .filter(product => {
                        return Number(product.price) >= self.minPrice && Number(product.price) <= self.maxPrice;
                })
            }
        },
    });