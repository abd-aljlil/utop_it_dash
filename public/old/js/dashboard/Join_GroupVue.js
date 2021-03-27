//Vue.component('v-select', VueSelect.VueSelect);
//Vue.component('FormWizard', VueFormWizard.VueFormWizard);
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
Groups        : []
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
          
            
            grid.fetch_Group_Timing(grid.Group_Id, grid.group_name_label,group_level_label);
          
      }
      })
      .catch(function (error) {
      });
  },
  fetch: function() {
    grid.errors = [];
    url = 'Group_Timing/fetch';
    axios.get(url).then( function (response)  {


      grid.Groups = response.data.TableData;
      })
   
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
                              label: 'تسجيل حضور الطلاب',
                              filterable: false,
                          },
                          {
                              label: 'تعديل المعلومات',
                              filterable: false,
                          },
                          {
                              label: 'رابط الوصول للمجموعة',
                              field: 'link',
                              filterable: true,
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
                              label: 'تسجيل /حذف درجة الحضور',
                              filterable: false,
                          },
                          {
                              label: 'درجة الحضور',
                              field: 'status',
                              filterable: true,
                          },
                          {
                              label: 'الاسم',
                              field: 'user_name',
                              filterable: true,
                          },
                          

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
    updateStudentStatus: function(id,status) {
      var url = 'Group_Timing_Attendee/' + id ;
    

      this.insertingdata = (
                             {available: !status}
                           )
      axios.put(url ,  this.insertingdata)
        .then(function (response) {
      
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
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
