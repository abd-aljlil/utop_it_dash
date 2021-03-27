Vue.component('v-select', VueSelect.VueSelect);
Vue.component('select2', {
  props: ['options', 'value'],
  template: '#select2-template1',
  mounted: function () {
    var vm = this
    $(this.$el)
      .val(this.value)
      // init select2
      .select2({ data: this.options })
      // emit event on change.
      .on('change', function () {
        vm.$emit('input', this.value)
      })
  },
  watch: {
    value: function (value) {
      // update value
      $(this.$el).val(value)
    },
    options: function (options) {
      // update options
      $(this.$el).select2({ data: options })
    }
  },
  destroyed: function () {
    $(this.$el).off().select2('destroy')
  }
})

Vue.component('data-grid', {
	template: '#grid-template',
	props: {
		data: Array,
		columns: Array,
		filterKey: String
	},
	data: function () {
		var sortOrders = {}
		this.columns.forEach(function (key) {
			sortOrders[key] = 1
		})
		return {
			sortKey: '',
			sortOrders: sortOrders
		}
	},
	computed: {
	filteredData: function () {
		var sortKey = this.sortKey
		var filterKey = this.filterKey && this.filterKey.toLowerCase()
		var order = this.sortOrders[sortKey] || 1
		var data = this.data
		if (filterKey) {
			data = data.filter(function (row) {
			return Object.keys(row).some(function (key) {
			return String(row[key]).toLowerCase().indexOf(filterKey) > -1
		})
		})
		}
		if (sortKey) {
			data = data.slice().sort(function (a, b) {
			a = a[sortKey]
			b = b[sortKey]
			return (a === b ? 0 : a > b ? 1 : -1) * order
		})
		}
		return data
	}
	},
	filters: {
		capitalize: function (str) {
		return str.charAt(0).toUpperCase() + str.slice(1)
	}
	},
	methods: {
		sortBy: function (key) {
			this.sortKey = key
			this.sortOrders[key] = this.sortOrders[key] * -1
		}

	}
})

var grid = new Vue({
el: '#grid',
data: {
TableTitle 	  : "" ,
columns    	  : [],
rows 	   	  : [],
paginate   	  : 'True',
tableStyle 	  : 'table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer',
insertingdata : [],
name 		  : '',
errors 	 	  : [],
id 			  : 0,
User_Level    : 0,
Levels        :['1','2','3','4','5','6'],
Roles:[],
User_Role:0,
},
methods :
{
	selectAll() {
      const select = this.$refs.select;
      select.options.forEach(option => {
        select.select(option);
      });
       select.open = false
 	},
 	selectAllExtra() {
      const select = this.$refs.select_extraexpenses;
      select.options.forEach(option => {
        select.select(option);
      });
       select.open = false
 	},
	Insert_Exam_Name: function() {
		this.insertingdata = ({name : grid.name})
		axios.post('Exam_Name', this.insertingdata )
		  .then(function (response) {
		  	if(response.data.errors)
		  	{
		  		grid.errors = response.data.errors;
		  		
		  
		  	}
		  	else
		  	{
			  	$('#closeinsert').trigger('click');
			  	grid.fetch();
			}
		  })
		  .catch(function (error) {
		  });
	},
	fetch: function() {
		grid.errors = [];
		url = 'User.fetch';
		axios.get(url).then( function (response)  {
			
			grid.rows = response.data.TableData;
			grid.Roles= response.data.RoleData;
		})
		grid.columns = [
                        {
                              label: 'الإجراءات',
                              filterable: false,
                          },
                           
                          {
                              label: 'طالب سابق',
                            
                              filterable: false,
                          },
                          {
                              label: 'المستوى',
                              field: 'user.level',
                              filterable: true,
                          },
                          {
                              label: 'الصلاحية',
                              field: 'role.name',
                              filterable: true,
                          },
                          {
                              label: 'الإيميل',
                              field: 'user.email',
                              filterable: true,
                          },
                          {
                              label: 'اسم المستخدم',
                              field: 'user.english_name',
                              filterable: true,
                          }
                        ]
	},
	ActivateUser: function(id) {
		grid.errors = [];
    	url = 'User/' + id + '/active' ;
		axios.post(url).then( function (response)  {
			grid.fetch();
		})
		
	},
	BlockUser: function(id) {
		grid.errors = [];
    	url = 'User/' + id + '/block' ;
		axios.post(url).then( function (response)  {
			grid.fetch();
			
		})
		
	},
	getUserLevel: function(id){
     url = 'User/' + id ;
			axios.get(url).then( function (response)  {
				
				grid.id   = id;
				grid.name= response.data.RecordData.english_name;
				grid.User_Level = response.data.RecordData.level;
			})
	},
	updateUserLevel: function(){
     var url = 'User/' + grid.id ;
      this.insertingdata = ({level : grid.User_Level})
      axios.put(url ,  this.insertingdata)
        .then(function (response) {
        	
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#closeupdateLevel').trigger('click');
            grid.fetch();
       	  }
          
        })
        .catch(function (error) {
        });
	},
	getUserRole: function(id){
     url = 'Role_User/' + id ;
			axios.get(url).then( function (response)  {
				
				grid.id   = id;
				grid.name= response.data.RecordData.user.english_name;
				grid.user_id= response.data.RecordData.user.id;
				grid.User_Role= {'label': response.data.RecordData.role.name,'value': response.data.RecordData.role.id};
				
			})
	},
	updateUserRole: function(){
     var url = 'Role_User/' + grid.id ;
      this.insertingdata = ({user_id: grid.user_id, role_id : grid.User_Role["value"]})
      axios.put(url ,  this.insertingdata)
        .then(function (response) {
        	
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#closeupdateRole').trigger('click');
            grid.fetch();
       	  }
          
        })
        .catch(function (error) {
        });
	},
    update: function() {
      var url = 'Exam_Name/' + grid.id ;
      this.insertingdata = ({name : this.name})
      axios.put(url ,  this.insertingdata)
        .then(function (response) {
        	
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#closeupdate').trigger('click');
            grid.fetch();
       	  }
          
        })
        .catch(function (error) {
        });
    },
	addOption: function(){
        var index = Object.keys(this.slippertype).length;
        this.slippertype.push({id:'',price:''});
      setTimeout(function(){
        $("#opt_select_0").select2();
      },100);      
    },
    deleteOption: function(index){
        this.slippertype.splice(index, 1);
    },
    getAll: function(){
        console.log(this.slippertype);
    },
    trashdata: function(id) {
    	if (confirm('أنت على وشك الحذف من فهرس اساسي سيؤدل ذلك إلى ضياع بالبيانات المرتبطة بهذا الفهرس ')) {
    	url = 'Exam_Name/' + id + '/trash' ;
    	axios.post(url)
		  .then(function (response) {
		  	grid.fetch();
		   
		  })
		  .catch(function (error) {
		    
		  });
		}
    },
		getdata: function(id) {
			url = 'Exam_Name/' + id + '/edit';
			axios.get(url).then( function (response)  {
				
			})
		}
},
mounted(){
    $(this.$refs.vuemodal).on("hidden", this.fetch);
    $(this.$refs.updatevuemodal).on("hidden", this.fetch);
    
  }
})

grid.fetch();


