Vue.component('v-select', VueSelect.VueSelect);
//Vue.component('FormWizard', VueFormWizard.VueFormWizard);

/*
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
*/
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
			sortOrders[key] = 3
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
    TableTitle 	    : "" ,
    columns    	    : [],
    rows 	   	      : [],
    paginate   	    : 'True',
    tableStyle 	    : 'table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer',
    insertingdata   : [],
    name 		        : '',
    errors 	 	      : [],
    id 			        : 0,
    code 		        : '',
    table_buttons   : 'Login',
    Questions 	    : '',
    answers 	      : [[]],
    answers_props   : '',
    files 		      : [],
    file            : '',
    UploadedFiles   : [],
    TimeToFinish    : 1000,
    remainingClass           : 'btn btn-primary',
    exam_name_index_users_id : 0,
    Counter : 0,
    prepared_answers : [],
   hours:0,
   rhours:0,
    minutes:0,
    rminutes:0,
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
 /*
  Update_Exam_Name_Index_Questions_Users() {
   
   grid.insertingdata = ({answers : grid.answers , 'active' : 0})
   axios.post('Exam_Name_Index_Questions_Users', grid.insertingdata)
   .then(function (response) {
        
         if(response.data.errors)
         {
          grid.errors = response.data.errors;
        }
        else
        {  
          
           
          }
        })
   .catch(function (error) {
   });
 },*/
 Insert_Exam_Name_Index_Questions_Users: function() {
  if(grid.TimeToFinish <= 0){
    grid.insertingdata = ({answers : grid.answers ,  'active' : 1})
    axios.post('Exam_Name_Index_Questions_Users', grid.insertingdata)
    .then(function (response) {
      if(response.data.errors)
      {
      grid.errors = response.data.errors;
      }
      else
      {  
        alert('Time is over! The result will be sent to your email.')
        var url = '/utopians_dashboard';
        window.location.href = url;
      }
    })
    .catch(function (error) {
    });
  }
},
myFunction:function(){
var myVideo = document.getElementById('myVideo');
  myVideo.addEventListener("focusout", function() {
    myVideo.pauseVideo();
  });

},
Confirm: function() {

  if (confirm('Are you sure you want to submit?')) {
    $('#grid').hide();
    grid.insertingdata = ({answers : grid.answers ,  'active' : 1})
    axios.post('Exam_Name_Index_Questions_Users', grid.insertingdata)
    .then(function (response) {
     if(response.data.errors)
     {
      $('#grid').show();
      grid.errors = response.data.errors;
    }
    else
      {  
        var url = '/utopians_dashboard';
        window.location.href = url;
      }
})
    .catch(function (error) {
    });
  }
},

fetch: function() {
  grid.errors = [];
  url = 'Exam_Name/fetch';
  axios.get('Exam_Name.fetch').then( function (response)  {

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
},
trashdata: function(id) {
 if (confirm('أنت على وشك الحذف من فهرس اساسي سيؤدل ذلك إلى ضياع بالبيانات المرتبطة بهذا الفهرس ')) {
   url = 'Exam_Name/' + id + '/trash' 
   axios.post(url)
   .then(function (response) {
     grid.fetch();

   })
   .catch(function (error) {

   });
 }
},
writeC: function(){

},
Exam_Login: function() {
 if(!grid.code)
 {
   grid.errors = {'code' : "الرجاء ادخال كود الامتحان"}
   return false;
 }
 url = 'ExamPage/' + grid.code;
 axios.get(url)
 .then( function (response)  {

  if(response.data.error)
  {
   alert(response.data.error)
 }
 else
 {
  grid.exam_name_index_users_id = response.data.exam_name_index_users_id

  grid.TimeToFinish  = response.data.TimeToFinish*60 ;
  grid.hours = (grid.TimeToFinish / 60);
grid.rhours = Math.floor(grid.hours);
grid.minutes = (grid.hours - grid.rhours) * 60;
grid.rminutes = Math.round(grid.minutes);

  if(grid.TimeToFinish <= 30)
  {
    grid.remainingClass = "btn btn-danger"
  }
  grid.table_buttons = "exam"
  grid.Questions     = response.data.exam_name_index_questions


  $.each( grid.Questions, function( key, value ) {
    grid.prepared_answers[value.id] = []
    grid.answers[value.id] = []
    $.each( value.exam_name_index_questions_users, function( answers_key, answers_value ) {

      if(value.answer_type === 'اختيار متعدد من متعدد')
      {

        if(String(answers_value.answer) === String(value.answer1))
        {
          grid.answers[value.id][1] = answers_value.answer
          grid.prepared_answers[value.id][1] = true
        }
        if(String(answers_value.answer) === String(value.answer2))
        { 
          grid.answers[value.id][2] = answers_value.answer
          grid.prepared_answers[value.id][2] = true
        }

        if(String(answers_value.answer) === String(value.answer3))
        {
          grid.answers[value.id][3] = answers_value.answer
          grid.prepared_answers[value.id][3] = true
        }

        if(String(answers_value.answer) === String(value.answer4))
        {
          grid.answers[value.id][4] = answers_value.answer
          grid.prepared_answers[value.id][4] = true
        }


      }else
      {
        grid.answers[value.id] =  answers_value.answer
      }

    });

  });

  $('#Exam_Login_Popup').modal('toggle');
}

})
 .catch(function (error) {

 });
},
getdata: function(id) {
  url = 'Exam_Name/' + id + '/edit';
  axios.get(url).then( function (response)  {
   grid.id   = response.data.RecordData.id;
   grid.name = response.data.RecordData.name;
 })
},
changeStatus: function() {
  this.boxStatus = !this.boxStatus;

},
handleFileUpload(exam_name_index_questions_id) {
 this.file = this.$refs.file[0].files[0];
 let formData = new FormData();
 formData.append('file', this.file);
 formData.append('exam_name_index_questions_id', exam_name_index_questions_id);
      //grid.insertingdata = ({answers : grid.answers , formData : formData})
      axios.post('Upload_Exam_Name_Index_Questions_Users_File', 
        formData,
        {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
      .then(function (response) {

        if(response.data.errors)
        {
          grid.errors = response.data.errors;


        }
        else
        {
          grid.UploadedFiles.push(response.data)
        }
      })
      .catch(function (error) {
      });
      
    },
    removeFile(id,index){
      if (confirm('هل تريد حذف الملف بالتأكيد')) {
        url = 'Exam_Name_Index_Questions_Users/' + id + '/trash' 
        axios.post(url)
        .then(function (response) {
          grid.UploadedFiles.splice(index,1)
        })
        .catch(function (error) {
        });
      }
    },
    push(id,index,answer){

    	if(!grid.answers[id] )
      {
        grid.answers[id] = []
        grid.prepared_answers[id] = []
      }
      if(grid.answers[id][index])
      {
        grid.answers[id][index] = ""
        grid.prepared_answers[id][index] = false
      }
      else
      {
        grid.answers[id][index] = answer
        grid.prepared_answers[id][index] = true
      }
     
   },

 },

 mounted(){
  $(this.$refs.vuemodal).on("hidden", this.fetch);
  $(this.$refs.updatevuemodal).on("hidden", this.fetch);

  window.setInterval(() => {
    grid.TimeToFinish = grid.TimeToFinish-5;
    grid.hours = (grid.TimeToFinish / 60);
grid.rhours = Math.floor(grid.hours);
grid.minutes = (grid.hours - grid.rhours) * 60;
grid.rminutes = Math.round(grid.minutes);
      grid.Counter = parseInt(grid.TimeToFinish / 60, 10) % 60
      if(grid.TimeToFinish <= 30)
      {
        grid.remainingClass = "btn btn-danger"
      }
      if(grid.TimeToFinish <= 0)
      {
        this.Insert_Exam_Name_Index_Questions_Users()
      }
    }, 5000)

    /*
    window.setInterval(() => {
      
      axios.post('Update_Exam_Name_Index_Users_Counter', {'id' : grid.exam_name_index_users_id})
        .then(function (response) {
         
          if(response.data.errors)
          {
            grid.errors = response.data.errors;
          }
          else
          {  
            //window.location.href = '/';
          }
        })
        .catch(function (error) {
        });
    }, 60000)
    */

  }

})


$( document ).ready(function() {

  $('#Exam_Login').trigger('click'); 
  $(document).keypress(function(e) {
    if ($("#recipient-name").hasClass('in') && (e.keycode == 13 || e.which == 13)) {
      alert("Enter is pressed");
    }
  });
});





