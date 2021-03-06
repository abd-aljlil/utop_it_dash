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
Lessons_Index_Id	       : 0,
table_buttons 		       : 'Lessons_Index',
Lessons_Archive_Date     : '',
Lessons_Archive_Id       : 0,
Lesson_Index_Name        : '',
Lessons_Archive_Files_Id : 0,
file                     : '',
Levels                   : [],
User_Level               : '',
level_name               :'',
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
		grid.errors = [];
    var level_name ='';
    if(grid.User_Level["value"]==1)
      level_name='A1';
      if(grid.User_Level["value"]==2)
      level_name='A2';
      if(grid.User_Level["value"]==3)
      level_name='A2-B1';
      if(grid.User_Level["value"]==4)
      level_name='B1';
      if(grid.User_Level["value"]==5)
      level_name='B2';
      if(grid.User_Level["value"]==6)
      level_name='C1';

		this.insertingdata = ({ level_string:level_name , level:grid.User_Level["value"]})
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
  Insert_Lessons_Archive_Files: function() {
    grid.errors = [];
    let formData = new FormData();
    /*
        Add the form data we need to submit
    */
    formData.append('lessons_archive_id' , this.Lessons_Archive_Id);
    formData.append('file', this.file);
    //this.insertingdata = ({ file : grid.file , lessons_archive_id : grid.Lessons_Archive_Id })
    axios.post( 'Lessons_Archive_Files',
        formData,
        {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        }
      ).then(function(response){
        
        $('#closeInsert_Lessons_Archive_Files').trigger('click');
        grid.Show_Lessons_Archive_Files(grid.Lessons_Archive_Id);
      })
      .catch(function(response){
        grid.errors = response.data.errors
      });
    
  },
  Show_Lessons_Archive_Files: function(id) {
    grid.errors = [];
    grid.table_buttons    = "Lessons_Archive_Files";
    grid.Lessons_Archive_Id = id;
    url                   = 'Lessons_Archive_Files/' + id;
    axios.get(url).then( function (response)  {
      grid.Lessons_Archive_Files_Id = response.data.RecordData.id;
      grid.rows                     = response.data.RecordData;
      grid.Lesson_Index_Name        = response.data.Lessons_Archive.date;
    })
    grid.columns = [
                          {
                              label: '??????',
                              filterable: false,
                          },                          
                          {
                              label: '??????????',
                              
                              filterable: false,
                          }
                        ]
  },
	Insert_Lessons_Archive: function() {
		grid.errors = [];
		this.insertingdata = ({date : grid.Lessons_Archive_Date , lessons_index_id : grid.Lessons_Index_Id})
		axios.post('Lessons_Archive', this.insertingdata )
		  .then(function (response) {
		  	if(response.data.errors)
		  	{
		  		grid.errors = response.data.errors;
		  	}
		  	else
		  	{
			  	$('#closeInsert_Lessons_Archive').trigger('click');
			  	grid.Show_Lessons_Archive(grid.Lessons_Index_Id);
			}
		  })
		  .catch(function (error) {
		  });
	},
	fetch: function() {
		grid.errors             = [];
    grid.Lesson_Index_Name  = '';
    grid.table_buttons = "Lessons_Index";
		url                     = 'Lessons_Index.fetch';
		axios.get(url).then( function (response)  {
			grid.rows   = response.data.TableData;
      grid.Levels = response.data.levels;
		})
		grid.columns = [
                          
                          {
                              label: 'Actions',
                              filterable: false,
                          },
                          
                          {
                              label: '?????? ??????????',
                              field: 'name',
                              filterable: true,
                          }
                        ]
	},
	Show_Lessons_Archive: function(id) {
		grid.errors = [];
		grid.table_buttons 	  = "Lessons_Archive";
		grid.Lessons_Index_Id = id;
		url 		  	   	      = 'Lessons_Archive/' + id;
		axios.get(url).then( function (response)  {
			grid.Lessons_Archive_Id = response.data.RecordData.id;
			grid.rows 	   			    = response.data.RecordData;
      grid.Lesson_Index_Name  = response.data.Lessons_Index.name;
		})
		grid.columns = [
                          
                          {
                              label: 'Actions',
                              filterable: false,
                          }
                          ,
                          {
                              label: '?????????? ??????????',
                              field: 'date',
                              filterable: true,
                          }
                        ]
	},

  Get_File: function(file){
   url = `/utopians_dashboard/uploads/lessons_files/` + file ;
    location.href = url;
  },
  Show_Lessons_Archive: function(id) {
    grid.errors = [];
    grid.table_buttons    = "Lessons_Archive";
    grid.Lessons_Index_Id = id;
    url                   = 'Lessons_Archive/' + id;
    axios.get(url).then( function (response)  {
      grid.Lessons_Archive_Id = response.data.RecordData.id;
      grid.rows               = response.data.RecordData;
      grid.Lesson_Index_Name  = response.data.Lessons_Index.name;
    })
    grid.columns = [
                          
                          {
                              label: 'Actions',
                              filterable: false,
                          }
                          ,
                          {
                              label: 'Status',
                              filterable: false,
                          }
                          ,
                          {
                              label: '?????????? ??????????',
                              field: 'date',
                              filterable: true,
                          }
                        ]
  },
    Update_Lessons_Index: function() {
    	grid.errors = [];
      	var url = 'Lessons_Index/' + grid.Lessons_Index_Id ;
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
    Update_Lessons_Archive: function() {
    	grid.errors = [];
      	var url = 'Lessons_Archive/' + grid.Lessons_Archive_Id;
      	this.insertingdata = ({ date : this.Lessons_Archive_Date , lessons_index_id : this.Lessons_Index_Id})
      	axios.put(url ,  this.insertingdata)
        .then(function (response) {
        	
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#closeUpdate_Lessons_Archive').trigger('click');
            grid.Show_Lessons_Archive(grid.Lessons_Index_Id);
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
    	if (confirm('?????? ?????? ?????? ?????????? ???? ???????? ?????????? ?????????? ?????? ?????? ???????? ?????????????????? ???????????????? ???????? ???????????? ')) {
    	url = 'Lessons_Index/' + id + '/trash' 
    	axios.post(url)
		  .then(function (response) {
		  	grid.fetch();
		   
		  })
		  .catch(function (error) {
		    
		  });
		}
    },
    Active_Lessons_Archive: function(id) {
      grid.errors = [];
      if (confirm('???? ???????? ?????????? ?????? ?????????? ???????????????? ')) {
      url = 'Lessons_Archive/' + id + '/active' 
      axios.post(url)
      .then(function (response) {
        
        grid.Show_Lessons_Archive(grid.Lessons_Index_Id);
       
      })
      .catch(function (error) {
        
      });
    }
    },
    Trash_Lessons_Archive_Data: function(id) {
    	grid.errors = [];
    	if (confirm('?????? ?????? ?????? ?????????? ???? ???????? ?????????? ?????????? ?????? ?????? ???????? ?????????????????? ???????????????? ???????? ???????????? ')) {
    	url = 'Lessons_Archive/' + id + '/trash' 
    	axios.post(url)
		  .then(function (response) {
		  	grid.Show_Lessons_Archive(grid.Lessons_Index_Id);
		   
		  })
		  .catch(function (error) {
		    
		  });}
    },
    Trash_Lessons_Archive_File: function(id) {
      grid.errors = [];
      if (confirm('???? ???????? ?????????? ???????????????? ')) {
      url = 'Lessons_Archive_Files/' + id + '/trash' 
      axios.post(url)
      .then(function (response) {
        grid.Show_Lessons_Archive_Files(grid.Lessons_Archive_Id);
       
      })
      .catch(function (error) {
        
      });}
    },
    Get_Lessons_Archive_Data: function(id) {
    	grid.errors = [];
    	grid.Lessons_Archive_Id = id;
  		url 		  	   	  = 'Lessons_Archive/' + id + '/edit';
  		grid.table_buttons 	  = 'Lessons_Archive';
  		axios.get(url).then( function (response)  {
			grid.Lessons_Archive_Date = response.data.RecordData.date;
      
		})
	},
    getdata: function(id) {
    	grid.errors = [];
		url 		  = 'Lessons_Index/' + id + '/edit';
		grid.table_buttons = 'Lessons_Index';
		axios.get(url).then( function (response)  {
			grid.Lessons_Index_Id   = response.data.RecordData.id;
			grid.name 				= response.data.RecordData.name;
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


