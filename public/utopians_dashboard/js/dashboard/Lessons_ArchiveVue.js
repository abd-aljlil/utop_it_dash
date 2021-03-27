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
id 			  : 0
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
	Insert_Lessons_Index: function() {
		this.insertingdata = ({name : grid.name})
		axios.post('Lessons_Index', this.insertingdata )
		  .then(function (response) {
		  	if(response.data.errors)
		  	{
		  		grid.errors = response.data.errors;
		  		
		  
		  	}
		  	else
		  	{
			  	$('#closeInsert_Lessons_Index').trigger('click');
			  	grid.fetch();
			}
		  })
		  .catch(function (error) {
		  });
	},
	fetch: function() {
		grid.errors = [];
		url = 'Lessons_Archive.fetch';
		axios.get(url).then( function (response)  {
		
			grid.rows = response.data.TableData;
		})
		grid.columns = [
                          {
                              label: 'حذف',
                              filterable: false,
                          },
                          {
                              label: 'تعديل',
                              filterable: false,
                          },
                          {
                              label: 'اسم الامتحان',
                              field: 'name',
                              filterable: true,
                          }
                        ]
	},
    Update_Lessons_Index: function() {
      var url = 'Lessons_Index/' + grid.id ;
      this.insertingdata = ({name : this.name})
      axios.put(url ,  this.insertingdata)
        .then(function (response) {
        	
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#closeUpdate_Lessons_Index').trigger('click');
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
    	url = 'Lessons_Index/' + id + '/trash' 
    	axios.post(url)
		  .then(function (response) {
		  	grid.fetch();
		   
		  })
		  .catch(function (error) {
		    
		  });
		}
    },
		getdata: function(id) {
			url = 'Lessons_Index/' + id + '/edit';
			axios.get(url).then( function (response)  {
				grid.id   = response.data.RecordData.id;
				grid.name = response.data.RecordData.name;
			})
		}
},
mounted(){
    $(this.$refs.vuemodal).on("hidden", this.fetch);
    $(this.$refs.updatevuemodal).on("hidden", this.fetch);
    
  }
})

grid.fetch();


