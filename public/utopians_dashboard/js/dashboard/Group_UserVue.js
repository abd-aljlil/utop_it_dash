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
TableTitle    : "" ,
columns       : [],
rows          : [],
paginate      : 'True',
tableStyle    : 'table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer',
insertingdata : [],
name          : '',
errors        : [],
id            : 0,
Groups        : [],
group_name    : '',
level         : '',
Teachers      : [],
user_name     : '',
user_id       : 0,
Levels        : ['1','2','3','4','5','6','7'],
day           : '',
time          : '00:00:00',
group_timing_link:'',
Days          : ['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'],
female_only   : 0,
table_buttons: 'Groups',
Group_Id: 0,
group_name_label: '',
user_level:0,
ActiveSessions: [],
session_timing:'', 
Interview_Date:'12-Jul-2018', 
Notify_User_Level: 0,
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
  Insert_Group: function() {
      var level_name ='';
      
      if(this.level==1)
      level_name='A1';
      if(this.level==2)
      level_name='A2';
      if(this.level==3)
      level_name='A2-B1';
      if(this.level==4)
      level_name='B1';
      if(this.level==5)
      level_name='B2';
      if(this.level==6)
      level_name='C1';
      
    this.insertingdata = ({user_id:this.user_id["value"], 
                           name:this.name, 
                           user_level:this.level,
                           level_string:level_name,
                           day: this.day,
                           time: this.time,
                           group_timing_link: this.group_timing_link,
                           female_only: this.female_only})
    axios.post('Group', this.insertingdata )
      .then(function (response) {
        
        if(response.data.errors)
        {
          grid.errors = response.data.errors;
          
      
        }
        else
        {
          $('#closeInsert').trigger('click');
          grid.fetch();
      }
      })
      .catch(function (error) {
      });
  },
  fetch: function() {
    grid.errors = [];
    url = 'Group_User/fetch';
    axios.get('Group_User.fetch').then( function (response)  {
        
      grid.id = response.data.Groups.id;
      grid.rows = response.data.Groups;
      grid.Teachers      = response.data.teachers;
      grid.table_buttons ='Groups';
    })
    grid.columns = [
                          {
                              label: 'تعديل',
                              filterable: false,
                          },
                          {
                              label: 'الحالة',
                              filterable: false,
                          },
                           {
                              label: 'نوع المجموعة',
                              filterable: false,
                          },
                          
                          {
                              label: 'يوم الجلسات',
                              field: 'day',
                              filterable: true,
                          },
                          {
                              label: 'وقت الجلسات',
                              field: 'time',
                              filterable: true,
                          },
                          {
                              label: 'الأستاذ المساعد',
                              field: 'user_name',
                              filterable: true,
                          },
                          {
                              label: 'مستوى المجموعة',
                              field: 'level',
                              filterable: true,
                          },
                          {
                              label: 'رقم الدورة',
                              field: 'course_number',
                              filterable: true,
                          },
                          {
                              label: 'اسم المجموعة',
                              field: 'group_name',
                              filterable: true,
                          }
                        ]
  },
    updateUser: function() {
      var url = 'Group_User/' + grid.id ;

      if(this.user_id == '') 
      { alert('يجب اختيار  المتطوع المسؤول'); return false;}

      this.insertingdata = ({user_id: this.user_id["value"], group_id: this.id})
      axios.put(url ,  this.insertingdata)
        .then(function (response) {
         
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            grid.user_id   = {'label' :  '' , 'value' :  '' };
        
            $('#closeUpdate').trigger('click');
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
      if (confirm('أنت على وشك حذف مجموعة طلابية .. هل أنت متأكد ؟')) {
      url = 'Group_User/' + id + '/trash' 
      axios.post(url)
      .then(function (response) {
        grid.fetch();
       
      })
      .catch(function (error) {
        
      });
    }
    },
    update: function() {
      var url = 'Group_Timing/' + grid.id ;
      this.insertingdata = (
                             {day  : this.day,
                              time : this.time,
                              group_timing_link : this.group_timing_link,}
                           )
      axios.put(url ,  this.insertingdata)
        .then(function (response) {
         
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#closeupdate').trigger('click');
            grid.table_buttons = 'Group_Timing';
            grid.fetch_Group_Timing(grid.Group_Id, grid.group_name_label);
          
          }
          
        })
        .catch(function (error) {
        });
    },
    getTimingdata: function(id) {
      url = 'Group_Timing/' + id ;
      axios.get(url).then( function (response)  {
        
        grid.id   = response.data.RecordData.id;
        grid.name = response.data.RecordData.name;
        grid.user_level = response.data.RecordData.level;
        grid.time = response.data.RecordData.time;
        grid.day = response.data.RecordData.day;
        grid.group_timing_link = response.data.RecordData.link;
      })
    },

    fetch_Group_Timing: function(id,name) {
    grid.Group_Id   = id; 
    grid.errors = [];
    url = 'Group_Timing/'+id+'/edit';
    axios.get(url).then( function (response)  {
     
      grid.table_buttons = 'Group_Timing';
      grid.rows = response.data.RecordData;
      grid.id   = response.data.RecordData.id;
      grid.group_name_label=name;
      
    })
    grid.columns = [
                          {
                              label: 'اجراءات',
                              filterable: false,
                          },
                          {
                              label: 'الحالة',
                              filterable: false,
                          },
                         
                          {
                              label: 'وقت اللقاء',
                              field: 'time',
                              filterable: true,
                          },
                          {
                              label: 'يوم اللقاء',
                              field: 'day',
                              filterable: true,
                          },
                          {
                              label: 'رقم الجلسة',
                              field: 'name',
                              filterable: true,
                          },
                          

                        ]
  },
  Activate: function(id) {
    grid.errors = [];
      url = 'Group/' + grid.Notify_User_Level + '/active' ;
    axios.post(url).then( function (response)  {
      $('#closeChoose_level_popup').trigger('click');
      grid.fetch();
    })
    
  },
  NotifInterviewDate: function() {
    var url = 'Interview_Date/'+grid.Interview_Date;
      this.insertingdata = (
                             {date: grid.Interview_Date}
                           )
      axios.post(url ,  this.insertingdata)
        .then(function (response) {
         
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#closeInterview_Date').trigger('click');
            grid.fetch();
          }
          
        })
        .catch(function (error) {
        });
    },
  getStudentSession: function(timing_Attendee_id) {
      url = 'Group_Timing_Attendee/' + timing_Attendee_id ;
      grid.id        = timing_Attendee_id;
      grid.session_timing= '';
      axios.get(url).then( function (response)  {
     
        
        grid.user_name      = response.data.RecordData.user_name;
        grid.user_level     = response.data.RecordData.level;
        grid.ActiveSessions = response.data.LevelActiveSessions; 
        
      })
    },
  updateStudentSession: function() {
      var url = 'Group_Timing_Attendee/' + grid.id ;
      this.insertingdata = (
                             {group_timing_id: grid.session_timing["value"]}
                           )
      axios.put(url ,  this.insertingdata)
        .then(function (response) {
         
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#closeupdateAttendee').trigger('click');
            grid.table_buttons = 'Group_Timing_Attendee';
            grid.getStudents(grid.group_timing_id,grid.group_timing_label)
          }
          
        })
        .catch(function (error) {
        });
    },
    updateStudentGroup: function() {
      var url = 'updateStudentGroup/' + grid.id ;
      this.insertingdata = (
                             {group_timing_id: grid.session_timing["value"]}
                           )
      axios.post(url ,  this.insertingdata)
        .then(function (response) {
         
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#closeupdateGroupAttendee').trigger('click');
            grid.table_buttons = 'Group_Timing_Attendee';
            grid.getStudents(grid.group_timing_id,grid.group_timing_label)
          }
          
        })
        .catch(function (error) {
        });
    },
  getStudents: function(id,name){
      grid.group_timing_id=id;
    grid.errors = [];
    url = 'Group_Timing_Attendee/'+id+'/edit';
    axios.get(url).then( function (response)  {
    
      
      grid.rows = response.data.RecordData;
      grid.id   = response.data.RecordData.id;
      grid.group_timing_label = name;
      grid.table_buttons = 'Group_Timing_Attendee';
    })
    grid.columns = [
                          
                          {
                              label: 'الإجراءات',
                              filterable: false,
                          },
                          {
                              label: 'حالة الحضور',
                              
                              filterable: false,
                          },
                          {
                              label: 'Total',
                              field: 'average',
                              filterable: true,
                          },
                          {
                              label: 'Fluency',
                              field: 'fluency',
                              filterable: true,
                          },
                          {
                              label: 'Grammar',
                              field: 'grammar',
                              filterable: true,
                          },
                          {
                              label: 'Over all achievement',
                              field: 'over_all_achievement',
                              filterable: true,
                          },
                          {
                              label: 'Composition skills',
                              field: 'composition_skills',
                              filterable: true,
                          },
                          {
                              label: 'Pronunciation',
                              field: 'pronunciation',
                              filterable: true,
                          },
                          {
                              label: 'الاسم',
                              field: 'user_name',
                              filterable: true,
                          },
                          

                        ]
  },
    getUserdata: function(id) {
      url = 'Group_User/' + id + '/edit';
      axios.get(url).then( function (response)  {
        
        grid.id        = response.data.Group.id;
        grid.name      = response.data.Group.group_name;
        grid.level     = response.data.Group.level;
        grid.day       = response.data.Group.day;
        grid.time      = response.data.Group.time;
        grid.group_timing_link      = response.data.Group.link;
        if(response.data.Group.user_name.length == 0) 
        grid.user_id   = {'label' :  'اختر متطوع' , 'value' :0 };
        else
        grid.user_id   = {'label' :  response.data.Group.user_name , 'value' :  response.data.Group.user_id };
        

        grid.Teachers      = response.data.teachers;
        
      })
    }
},

mounted(){
    $(this.$refs.vuemodal).on("hidden", this.fetch);
    $(this.$refs.updatevuemodal).on("hidden", this.fetch);
    
  }
})

grid.fetch();

