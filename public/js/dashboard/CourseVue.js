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
table_buttons            :'',
errors 	 	  		         : [],
announcement             : '',
table_buttons            :'',
id                       :0,
name                     :'',
video_intro              :'',
course_id                :0,
level_id                 :0,
start_date               :'2018-01-01',
end_date                 :'2018-01-01',
mid_term_test_date       :'2018-01-01',
final_test_date          :'2018-01-01',
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
  fetch_levels: function(id) {
    grid.errors             = [];
    grid.course_id          = id;
    grid.table_buttons  = 'courses_levels';
    url                     = 'Courses/'+grid.course_id;
    axios.get(url).then( function (response)  {
      grid.rows   = response.data.TableData;
      console.log(grid.rows);
    })
    grid.columns = [
                          
                          {
                              label: 'Actions',
                              filterable: false,
                          },
                           {
                              label: 'عدد طلاب المستوى',
                              field: 'user_count',
                              filterable: true,
                          },

                          {
                              label: 'المستوى',
                              field: 'level',
                              filterable: true,
                          },
                    
                        ]
  },
calculate_students_totals: function(level) {
    grid.errors = [];
    url = 'calculate_students_totals/' + level + '/'+ grid.course_id ;
    axios.post(url).then( function (response)  {
      grid.fetch_levels(grid.course_id);
      alert("تم حساب المجموع النهائي لطلاب المستوى بنجاح");
    })
},
calculate_success: function(id) {
    grid.errors = [];
    url = 'calculate_success_percent/' + id ;
    axios.get(url).then( function (response)  {
      grid.fetch();
      alert("نسبة الناجحين تساوي " + response.data.RecordData.percent + " || "+ "عدد الطلاب " + response.data.RecordData.count_all + " || "+"عدد الناجحين " + response.data.RecordData.count_success );
    })
},
fetch_students_groups: function(id) {
    grid.errors             = [];
    grid.level_id          = id;
    grid.table_buttons  = 'courses_levels_groups';
    url                     = 'Course_Level_Students_Groups/'+grid.course_id+'/'+grid.level_id;
    axios.get(url).then( function (response)  {
      grid.rows   = response.data.TableData;
      console.log(grid.rows);
    })
    grid.columns = [
                         
                          {
                              label: 'علامة النهائي',
                              field: 'final_test_mark',
                              filterable: true,
                          },
                           {
                              label: 'علامة النصفي',
                              field: 'midterm_test_mark',
                              filterable: true,
                          },
                           
                         
                           {
                              label: 'علامة المقابلة',
                              field: 'interview_average',
                              filterable: true,
                          },
                          {
                              label: 'علامة تحديد المستوى',
                              field: 'placement_test_mark',
                              filterable: true,
                          },
                          {
                              label: 'اسم المجموعة',
                              field: 'group_name',
                              filterable: true,
                          },
                          {
                              label: 'الإيميل',
                              field: 'email',
                              filterable: true,
                          },

                           {
                              label: 'اسم الطالب',
                              field: 'english_name',
                              filterable: true,
                          },
                          {
                              label: 'رقم الطالب',
                              field: 'user_id',
                              filterable: true,
                          },
                    
                        ]
  },
 
  fetch_students: function(id) {
    grid.errors             = [];
    grid.level_id          = id;
    grid.table_buttons  = 'courses_levels_students';
    url                     = 'Course_Level_Students/'+grid.course_id+'/'+grid.level_id;
    axios.get(url).then( function (response)  {
      grid.rows   = response.data.TableData;
      console.log(grid.rows);
    })
    grid.columns = [
                         {
                              label: 'Final Total',
                              field: 'total',
                              filterable: true,
                          },
                         {
                              label: 'Sum Composition Skills',
                              field: 'sum_composition',
                              filterable: true,
                          },
                          

                          {
                              label: 'مجموع المشاركة',
                              field: 'sum_part',
                              filterable: true,
                          },
                          {
                              label: 'عدد الجلسات التي حضرها ',
                              field: 'available_sessions_no',
                              filterable: true,
                          },
                          {
                              label: 'علامة النهائي',
                              field: 'final_test_mark',
                              filterable: true,
                          },
                           {
                              label: 'علامة النصفي',
                              field: 'midterm_test_mark',
                              filterable: true,
                          },
                           {
                              label: 'علامة تحديد المستوى',
                              field: 'placement_test_mark',
                              filterable: true,
                          },
                         
                           {
                              label: 'علامة المقابلة',
                              field: 'interview_average',
                              filterable: true,
                          },
                          {
                              label: 'الإيميل',
                              field: 'email',
                              filterable: true,
                          },

                           {
                              label: 'اسم الطالب',
                              field: 'english_name',
                              filterable: true,
                          },
                          {
                              label: 'رقم الطالب',
                              field: 'user_id',
                              filterable: true,
                          },
                    
                        ]
  },
	fetch: function() {
		grid.errors             = [];
    grid.table_buttons  = 'courses';
		url                     = 'Courses.fetch';
		axios.get(url).then( function (response)  {
			grid.rows   = response.data.Courses;
      console.log(grid.rows);
		})
		grid.columns = [
                          
                          {
                              label: 'Actions',
                              filterable: false,
                          },
                          {
                              label: 'حالة الدورة',
                             
                              filterable: false,
                          },
                          {
                              label: 'تاريخ الامتحان النهائي',
                              field: 'final_test_date',
                              filterable: true,
                          },
                          {
                              label: 'تاريخ الامتحان النصفي',
                              field: 'mid_term_test_date',
                              filterable: true,
                          },
                          {
                              label: 'تاريخ نهاية الدورة',
                              field: 'end_date',
                              filterable: true,
                          },
                          {
                              label: 'تاريخ بداية الدورة',
                              field: 'start_date',
                              filterable: true,
                          },
                          {
                              label: 'وصف الدورة',
                              field: 'name',
                              filterable: true,
                          },
                          {
                              label: 'رقم الدورة',
                              field: 'id',
                              filterable: true,
                          }
                    
                        ]
	},
  Update_Course: function() {
    	grid.errors = [];
      	var url = 'Courses/' + grid.id ;
      	this.insertingdata = ({
          name               :this.name,
          video_intro        :this.video_intro,
          start_date         :this.start_date,
          end_date           :this.end_date,
          mid_term_test_date :this.mid_term_test_date,
          final_test_date    :this.final_test_date
         })
      	axios.put(url ,  this.insertingdata)
        .then(function (response) {
        	
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#Close_Update_Course').trigger('click');
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
    Activate: function(id) {
       if (confirm('أنت على وشك إلغاء تفعيل باقي الدورات و تفعيل هذه الدورة .. هل أنت متأكد ؟ ')){
    grid.errors = [];
      url = 'Courses/' + id + '/active' ;
    axios.post(url).then( function (response)  {
      grid.fetch();
    })
   } 
  },
    getdata: function(id) {
    	grid.errors = [];
		url 		  = 'Courses/' + id + '/edit';
		//grid.table_buttons = 'Lessons_Index';
		axios.get(url).then( function (response)  {
      grid.id                   = response.data.RecordData.id;
      grid.name                 = response.data.RecordData.name;
      grid.video_intro          = response.data.RecordData.video_intro;
      grid.start_date           = response.data.RecordData.start_date;
      grid.end_date             = response.data.RecordData.end_date;
      grid.mid_term_test_date   = response.data.RecordData.mid_term_test_date;
      grid.final_test_date      = response.data.RecordData.final_test_date;
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

function StoreStyle(){
  $('#tableToExcel').hide();
  $('#ReportStyle').show();
  for (var i = grid.columns.length - 1; i >= 0; i--) {
      grid.columns[i]["filterable"] = true
    }
  grid.paginate = true
}

function ReportStyle(){
  for (var i = grid.columns.length - 1; i >= 0; i--) {
      grid.columns[i]["filterable"] = false
    }
  grid.paginate = false
  $('#tableToExcel').show();
  $('#ReportStyle').hide();
}

var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
    StoreStyle();
  }
})()


