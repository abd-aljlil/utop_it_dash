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
TableTitle 	  		       : "" ,
columns    	  		       : [],
rows 	   	  		         : [],
paginate   	  		       : 'True',
tableStyle 	  		       : 'table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer',
insertingdata 		       : [],
name 		  		           : '',
errors 	 	  		         : [],
announcement             : '',
table_buttons            :'',
announcement_id          :0,
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
	Insert_Announcement: function() {
		grid.errors = [];

		this.insertingdata = ({ announcement:grid.announcement})
		axios.post('Announcement', this.insertingdata )
		  .then(function (response) {
      
		  	if(response.data.errors)
		  	{
		  		grid.errors = response.data.errors;
		  	}
		  	else
		  	{
			  	$('#closeInsert_Announcement').trigger('click');
			  	grid.fetch();

			}
		  })
		  .catch(function (error) {
		  });
	},
	fetch: function() {
		grid.errors             = [];
    grid.announcement  = '';
		url                     = 'Announcement.fetch';
		axios.get(url).then( function (response)  {
			grid.rows   = response.data.Announcements;
      console.log(grid.rows);
		})
		grid.columns = [
                          
                          {
                              label: 'Actions',
                              filterable: false,
                          },
                          {
                              label: 'تاريخ الإنشاء ',
                              field: 'created_at',
                              filterable: false,
                          },
                          
                          {
                              label: 'الإعلان',
                              field: 'announcement',
                              filterable: true,
                          }
                        ]
	},
  Update_Announcement: function() {
    	grid.errors = [];
      	var url = 'Announcement/' + grid.announcement_id ;
      	this.insertingdata = ({announcement : this.announcement})
      	axios.put(url ,  this.insertingdata)
        .then(function (response) {
        	
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#Close_Update_Announcement').trigger('click');
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
    	grid.errors = [];
    	if (confirm('أنت على وشك حذف الإعلان .. هل أنت متأكد ؟')) {
    	url = 'Announcement/' + id + '/trash' 
    	axios.post(url)
		  .then(function (response) {
		  	grid.fetch();
		   
		  })
		  .catch(function (error) {
		    
		  });
		}
    },
    getdata: function(id) {
    	grid.errors = [];
		url 		  = 'Announcement/' + id + '/edit';
		//grid.table_buttons = 'Lessons_Index';
		axios.get(url).then( function (response)  {
			grid.announcement 				= response.data.RecordData.announcement;
      grid.announcement_id      = response.data.RecordData.id;
		})
		},
     handleFileUpload() {
      this.file = this.$refs.file.files[0];
    }
},
mounted(){
    $(this.$refs.vuemodal).on("hidden", this.fetch);
    $(this.$refs.updatevuemodal).on("hidden", this.fetch);
    
  }
})

grid.fetch();


