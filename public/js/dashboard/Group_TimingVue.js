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
Days          : ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
day           : '',
time          : '00:00 AM',
user_level    : 0,
table_buttons : 'Groups',
Group_Id      : 0,
group_timing_link:'',
group_name_label:'',
group_level_label:'',
group_timing_id:0,
fluency       :0.0,
grammar       :0.0,
pronunciation :0.0,
composition_skills:0.0,
over_all_achievement:0.0,
status:1,
user_name:'',
vocabulary:0.0,
comprehension:0.0,
average:0.0,
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
    this.insertingdata = ({name : grid.name})
    axios.post('Groups', this.insertingdata )
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
  Insert_Group_Timing: function() {
    this.insertingdata = ({group_id : this.Group_Id,
                           day : this.day,
                           time: this.time,
                           group_timing_link : this.group_timing_link
                         })
    axios.post('Group_Timing', this.insertingdata )
      .then(function (response) {
        
        if(response.data.errors)
        {
          grid.errors = response.data.errors;
          
      
        }
        else
        {
          $('#closeInsertTiming').trigger('click');
          
            grid.table_buttons = 'Group_Timing';
            grid.fetch_Group_Timing(grid.Group_Id, grid.group_name_label,grid.group_level_label);
      }
      })
      .catch(function (error) {
      });
  },
  fetch: function() {
    grid.errors = [];
    grid.table_buttons = 'Groups';
    url = 'Group/fetch';
    axios.get('Group.fetch').then( function (response)  {


      grid.rows = response.data.TableData;
      grid.id   = response.data.TableData.id;
    })
    grid.columns = [
                          {
                              label: 'Actions',
                              filterable: false,
                          },
                          {
                              label: 'Group Name',
                              field: 'name',
                              filterable: true,
                          },
                          {
                              label: 'Group Level',
                              field: 'user_level',
                              filterable: true,
                          },
                          
                        ]
  },
  fetch_Group_Timing: function(id,name,level) {
    grid.Group_Id   = id; 
    grid.errors = [];
    url = 'Group_Timing/'+id+'/edit';
    axios.get(url).then( function (response)  {
       
      grid.table_buttons = 'Group_Timing';
      grid.rows = response.data.RecordData;
      grid.id   = response.data.RecordData.id;
      grid.group_level_label=level;
      grid.group_name_label=name;
      
    })
    grid.columns = [
                          {
                              label: 'Actions',
                              filterable: false,
                          },
                          {
                              label: 'Status',
                              filterable: false,
                          },
                          {
                              label: 'Session No.',
                              field: 'name',
                              filterable: true,
                          },
                          {
                              label: 'Time',
                              field: 'time',
                              filterable: true,
                          },
                          {
                              label: 'Day',
                              field: 'day',
                              filterable: true,
                          },
                          
                          

                        ]
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
            grid.fetch_Group_Timing(grid.Group_Id, grid.group_name_label,grid.group_level_label);
          
          }
          
        })
        .catch(function (error) {
        });
    },
    Active_Group_Timing: function(id) {
      grid.errors = [];
      if (confirm('Are you Sure ??')){
      url = 'Group_Timing/'+id+'/active' ;   
      axios.post(url)
      .then(function (response) {
        
        grid.table_buttons = 'Group_Timing';
            grid.fetch_Group_Timing(grid.Group_Id, grid.group_name_label,grid.group_level_label);
          
      })
      .catch(function (error) {
        
      });
    }
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
      
    },
    trashdata: function(id) {
      if (confirm('أنت على وشك حذف مجموعة طلابية .. هل أنت متأكد ؟')) {
      url = 'Group_Timing/' + id + '/trash' 
      axios.post(url)
      .then(function (response) {
        grid.fetch();
       
      })
      .catch(function (error) {
        
      });
    }
    },
    getStudents(id){
      grid.group_timing_id=id;
    grid.errors = [];
    url = 'Group_Timing_Attendee/'+id+'/edit';
    axios.get(url).then( function (response)  {
    
      grid.table_buttons = 'Group_Timing_Attendee';
      grid.rows = response.data.RecordData;
      grid.id   = response.data.RecordData.id;
     
      
    })
    grid.columns = [
                          
                          {
                              label: 'Actions',
                              filterable: false,
                          },
                          {
                              label: 'Attendance Status',
                              
                              filterable: false,
                          },
                           {
                              label: 'Student Name',
                              field: 'user_name',
                              filterable: true,
                          },
                          
                          {
                              label: 'Over all Achievement',
                              field: 'over_all_achievement',
                              filterable: false,
                          },

                          {
                              label: 'Pronunciation',
                              field: 'pronunciation',
                              filterable: false,
                          },
                          {
                              label: 'Grammar',
                              field: 'grammar',
                              filterable: false,
                          },
                          {
                              label: 'Fluency',
                              field: 'fluency',
                              filterable: false,
                          },
                          {
                              label: 'Total',
                              field: 'average',
                              filterable: false,
                          },
                          {
                              label: 'Composition Skills',
                              field: 'composition_skills',
                              filterable: false,
                          }
                         
                          

                        ]
  },
    getdata: function(id) {
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

    getStudentStatus: function(id){
      url = 'getMarks/'+ id  ;
      axios.get(url).then( function (response)  {
        
        grid.id   = response.data.RecordData.id;
        grid.user_name = response.data.RecordData.user_name;
        grid.fluency = response.data.RecordData.fluency;
        grid.pronunciation = response.data.RecordData.pronunciation;
        grid.grammar = response.data.RecordData.grammar;
        grid.composition_skills = response.data.RecordData.composition_skills;
        grid.over_all_achievement=response.data.RecordData.over_all_achievement;
        grid.status=grid.status;
      })
    },

    fetch_Student_Marks: function(id,name,level){
      grid.Group_Id   = id; 
      grid.errors = [];
      url = 'User_Marks/'+id+'/edit';
      axios.get(url).then( function (response)  {
       
       grid.table_buttons = 'User_Marks';
       grid.rows = response.data.RecordData;
       grid.id   = response.data.RecordData.id;
       grid.group_level_label=level;
       grid.group_name_label=name;
       
     })
      grid.columns = [
      {
        label: 'Actions',
        filterable: false,
      },
      {
        label: 'Student Name',
        field: 'user_name',
        filterable: true,
      },
      {
        label: 'Interview Average',
        field: 'interview_average',
        filterable: true,
      },
      {
        label: 'Interview Pronunciation',
        field: 'interview_pronunciation',
        filterable: true,
      },
      {
        label: 'Interview Vocabulary',
        field: 'interview_vocabulary',
        filterable: true,
      },
      {
        label: 'Interview Grammar',
        field: 'interview_grammar',
        filterable: true,
      },
      {
        label: 'Interview Fluency',
        field: 'interview_fluency',
        filterable: true,
      },
      {
        label: 'Interview Comprehension',
        field: 'interview_comprehension',
        filterable: true,
      },
      


      ]

    },
    getUserMark: function(id){
      url = 'User_Marks/'+ id  ;
      axios.get(url).then( function (response)  {
        
        grid.id   = response.data.RecordData.id;
        grid.user_name = response.data.RecordData.user_name;
        grid.fluency = response.data.RecordData.interview_fluency;
        grid.pronunciation = response.data.RecordData.interview_pronunciation;
        grid.grammar = response.data.RecordData.interview_grammar;
        grid.vocabulary = response.data.RecordData.interview_vocabulary;
        grid.comprehension=response.data.RecordData.interview_comprehension;
        grid.average=response.data.RecordData.interview_average;
      })
    },

    updateUserMarks: function() {
      var url = 'User_Marks/' + grid.id ;
     if (this.fluency>5 || this.pronunciation>5 || this.grammar>5|| this.vocabulary>5||this.comprehension>5){ alert ("You can't enter values greater than 5 !");} else {

      this.insertingdata = (
                             {
                              interview_fluency:   this.fluency,
                              interview_pronunciation: this.pronunciation,
                              interview_grammar: this.grammar,
                              interview_vocabulary: this.vocabulary,
                              interview_comprehension: this.comprehension,
                              
                              }
                           )
      axios.put(url ,  this.insertingdata)
        .then(function (response) {
     
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#closeupdateMarks').trigger('click');
            grid.table_buttons = 'User_Marks';
            grid.fetch_Student_Marks(grid.Group_Id,grid.group_name_label,grid.group_level_label);
          }
          
        })
        .catch(function (error) {
        });
  }  },

    updateStudentStatus: function() {
      var url = 'updateMarks/' + grid.id ;
    

      this.insertingdata = (
                             {available: this.status,
                              fluency:   this.fluency,
                              pronunciation: this.pronunciation,
                              grammar: this.grammar,
                              composition_skills: this.composition_skills,
                              over_all_achievement: this.over_all_achievement,
                              
                              }
                           )
      axios.post(url ,  this.insertingdata)
        .then(function (response) {
      
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#closeupdateAttendee').trigger('click');
            grid.table_buttons = 'Group_Timing_Attendee';
            grid.getStudents(grid.group_timing_id);
          }
          
        })
        .catch(function (error) {
        });
    },
},
 

mounted(){
    $(this.$refs.vuemodal).on("hidden", this.fetch);
    $(this.$refs.updatevuemodal).on("hidden", this.fetch);
    
  }
})

grid.fetch();
