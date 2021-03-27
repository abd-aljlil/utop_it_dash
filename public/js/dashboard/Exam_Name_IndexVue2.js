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
TableTitle        : "" ,
columns           : [],
rows              : [],
paginate          : 'True',
tableStyle        : 'table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer',
insertingdata     : [],
name              : '',
errors            : [],
id                : 0,
Exam_Name         : [],
Exam_Name_Id      : '',
period            : 90,
date              : '2018-01-01',
table_buttons     : 'Exam_Name_Index',
Question_Types    : [],
Question_Types_Id : '',
text              : '',
exam_name_index_id:0,
answer1           : '',
answer2           : '',
answer3           : '',
answer4           : '',
correct_answer    : '',
answer            : '',
Answers_Array     : [],
Answers           : '',
answer            : '',
Correct_Answers   : [],
Correct_Answer    : '',
Levels            : [],
Groups            : [],
Users             : [],
Level_id          : '',
Group_id          : '',
User_id           : '',
exam_name_label   : '',
percent           : 0.00,
Answer_Type       : '',
Answer_Types      : ['اختيار واحد من متعدد','اختيار متعدد من متعدد','ملف','نص','صح أم خطأ'],
question_percent  : 0.00,
question_order    : 0,
file              : '',
link              : '',
exam_index_percent: 0.00,
Exam_Index_Sum_Questions_Percents: 0.00,
Questions         : [],
percent           : [],
temporary_question_percent : [],
temporary_max_value : [],
Exam_Type : 0,
exam_type: '',


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
  Setpercent: function(index){
    var Sum_percent       = 0
    var Temporary_percent = 0
    var Difference        = 0
    var temporary_max_value_suspend = 100
    grid.Questions[index].question_percent = grid.temporary_question_percent[index]

    for( i =  0 ; i <= index ; i++)
    {
      Sum_percent = parseInt(Sum_percent) + parseInt(grid.Questions[i].question_percent)
    }
    temporary_max_value_suspend = 100 - Sum_percent
    Difference = 100 - Sum_percent
    Temporary_percent = ((Difference) / (grid.Questions.length - (index + 1))) | 0
    
    for( i =  index + 1 ; i < grid.Questions.length ; i++)
    {
      grid.Questions[i].question_percent = Temporary_percent
    
      Sum_percent = parseInt(Sum_percent) + parseInt(grid.Questions[i].question_percent)
      grid.temporary_max_value[i] = temporary_max_value_suspend 
    } 
  

    if(Sum_percent < 100)
    {
      Sum_percent = 100 - Sum_percent;
      if(index < grid.Questions.length)
        grid.Questions[index+1].question_percent = parseInt(Sum_percent) + parseInt(grid.Questions[index+1].question_percent)
      else
        grid.Questions[index].question_percent = parseInt(Sum_percent) + parseInt(grid.Questions[index].question_percent)
    }

  },
  Setpeorder: function(index){
    grid.Questions[index].question_order = grid.temporary_question_percent[index]
    


  },
	Insert_Exam_Name_Index: function() {
		this.insertingdata = ({
                            exam_name_id : grid.Exam_Name_Id["value"] , 
                            date         : grid.date , 
                            period       : grid.period,
                            exam_percent : grid.percent ,
                            exam_type    : grid.Exam_Type
                         })
		axios.post('Exam_Name_Index', this.insertingdata )
		  .then(function (response) {
        
		  	if(response.data.errors)
		  	{
		  		grid.errors = response.data.errors;
		  	}
		  	else
		  	{
			  	$('#Close_Insert_Exam_Name_Index').trigger('click');
			  	grid.fetch();
			}
		  })
		  .catch(function (error) {
		  });
	},
  Insert_level_setting_exam_percent: function() {
    this.insertingdata = ({ level : grid.Level_id["value"] , percent : grid.percent , exam_name_index_id : grid.exam_name_index_id})
    axios.post('level_setting_exam_percent', this.insertingdata )
      .then(function (response) {
        
        if(response.data.errors)
        {
          grid.errors = response.data.errors;
          
      
        }
        else
        {
          $('#Close_Insert_level_setting_exam_percent').trigger('click');
          grid.Fetch_level_setting_exam_percent(grid.exam_name_index_id);
      }
      })
      .catch(function (error) {
      });
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
  Insert_Question_Types: function() {
    this.insertingdata = ({name : grid.name})
    axios.post('Question_Types', this.insertingdata )
      .then(function (response) {
        if(response.data.errors)
        {
          grid.errors = response.data.errors;
          
      
        }
        else
        {
          $('#Close_Insert_Question_Types').trigger('click');
          //grid.fetch();
          grid.Fetch_Question_Types();
      }
      })
      .catch(function (error) {
      });
  },
  SetExam_Name_Index: function(id,name) {
    grid.Exam_Name_Index_Id = id;
    grid.exam_name_label    = name;
  },
  Insert_Exam_Name_Index_Questions: function() {
    grid.errors = [];
    let formData = new FormData();
    formData.append('exam_name_index_id' , grid.Exam_Name_Index_Id);
    formData.append('Question_Types_Id', grid.Question_Types_Id["value"]);
    formData.append('text', grid.text);
    formData.append('link', grid.link);
    formData.append('file', grid.file);
    for (var i = 0; i < grid.Answers_Array.length; i++) {
      formData.append('answer'+[i+1], grid.Answers_Array[i]["value"]);
    }
    for (var i = 0; i < grid.Correct_Answers.length; i++) {
      formData.append('correct_answer'+[i+1], grid.Correct_Answers[i]["value"]);
    }
    formData.append('question_percent', grid.question_percent);
    formData.append('answer_type', grid.Answer_Type);
    formData.append('correct_answer', grid.Correct_Answer);
    
   
    if(grid.Answer_Type=='اختيار واحد من متعدد')
   formData.append('correct_answer1', grid.Correct_Answer);
    
    axios.post( 'Exam_Name_Index_Questions',
        formData,
        {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        }
      ).then(function(response){
        
        grid.table_buttons = 'Exam_Name_Index_Questions';
        $('#Close_Insert_Exam_Questions').trigger('click');
        grid.Get_Questions_data(grid.Exam_Name_Index_Id,grid.exam_name_label,grid.exam_index_percent,grid.exam_type);
      })
      .catch(function(response){
        grid.errors = response.data.errors;
      });
   
  },
  Insert_Exam_Name_Index_Users: function() {

    this.insertingdata = ({
                            exam_name_index_id : grid.Exam_Name_Index_Id,
                            levels             : grid.Level_id,
                            groups             : grid.Group_id,
                            users              : grid.User_id,
                         })
    axios.post('Exam_Name_Index_Users', this.insertingdata )
      .then(function (response) {
        
        grid.table_buttons = 'Exam_Name_Index_Questions';
        if(response.data.errors)
        {
          grid.errors = response.data.errors;
        }
        else
        {
          $('#Close_Insert_Exam_Name_Index_Users').trigger('click');
          grid.Fetch_Exam_Name_Index_Users(grid.Exam_Name_Index_Id,grid.exam_name_label);
      }
      })
      .catch(function (error) {
      });
  },
  Fetch_Exam_Name_Index_Users: function(id,name) {
    grid.Exam_Name_Index_Id = id;
    grid.exam_name_label    = name;
    grid.errors = [];
    url = 'Exam_Name_Index_Users/' + id ;
    axios.get(url).then( function (response)  {
      
      grid.rows          = response.data.users;
      grid.table_buttons = 'Exam_Name_Index_Users';
    })
    grid.columns = [
                          {
                              label: 'حذف',
                              filterable: false,
                          },
                          {
                              label: 'النتيجة',
                              field: 'result',
                              filterable: true,
                          },
                          {
                              label: 'حالة الطالب',
                              field: 'active',
                              filterable: true,
                          },
                          {
                              label: 'اسم الطالب',
                              field: 'english_name',
                              filterable: true,
                          }
                        ]
  },
  trash_Exam_Name_Index_Users: function(id) {
      if (confirm('هل تريد حذف الطالب من هذا الامتحان بالتأكيد ')) {
      url = 'Exam_Name_Index_Users/' + id + '/trash' 
      axios.post(url)
      .then(function (response) {
        grid.Fetch_Exam_Name_Index_Users(grid.Exam_Name_Index_Id,grid.exam_name_label);
       
      })
      .catch(function (error) {
        
      });
      }
    },
    trash_level_setting_exam_percent: function(id) {
      if (confirm('هل  تريد الحذف بكل تأكيد')) {
      url = 'level_setting_exam_percent/' + id + '/trash' 
      axios.post(url)
      .then(function (response) {
        grid.Fetch_level_setting_exam_percent(grid.exam_name_index_id);
       
      })
      .catch(function (error) {
        
      });
      }
    },
  //New Functions    
    Create_Answer: function() {
      if(this.Answers_Array.length > 3)
        {
          alert("لا يمكن إضافة المزيد من الأجوبة");
          return false;
        }
      this.Answers_Array.push({'label' :  this.answer , 'value' :  this.answer });
      this.Answers = {'label' :  this.answer , 'value' :  this.answer }; 
      this.answer  = ''; 
    },
    Remove_Answer: function() {
      this.Correct_Answers.splice(this.Correct_Answers.indexOf(this.Answers) , 1); 
      //if(this.Correct_Answer == this.Answers)
       // this.Correct_Answer = '';

      this.Answers_Array.splice(this.Answers_Array.indexOf(this.Answers) , 1); 
      this.Answers = this.Answers_Array[0];
      this.Answers = this.Correct_Answers[0];   

    },
    Remove_Correct_Answer: function() {
      this.Correct_Answers.splice(this.Correct_Answers.indexOf(this.Answers) , 1); 
      this.Correct_Answer = this.Correct_Answers[0];
      //if(this.Correct_Answer == this.Answers)
       this.Correct_Answer = '';

    },
    Set_Correct_Answer: function() {
    if(this.Answer_Type=='اختيار متعدد من متعدد')
      {if(this.Correct_Answers.length > 2)
        {
          alert("لا يمكن إضافة المزيد من الأجوبة");
          return false;
        }
        if((this.Answers_Array.length-1) == this.Correct_Answers.length )
        {
          alert("عدد الإجابات الصحيحة لا يمكن أن يساوي عدد قائمة الإجابات");
          return false;
        }

      //this.Correct_Answer = this.Answers ;
      this.Correct_Answers.push({'label' :  this.Answers['value'] , 'value' :  this.Answers['value'] });
      this.Correct_Answer = {'label' :  this.Answers['value'] , 'value' :  this.Answers['value'] }; 
      //this.answer  = ''; 
      }
     else
       this.Correct_Answer=this.Answers['value'];
     
    },
  Get_Questions_data: function(id,name,percent,type) {
 
    grid.Exam_Name_Index_Id = id;
    grid.exam_name_label    = name;
    grid.exam_index_percent = percent;
    grid.errors             = [];
    grid.correct_answers    = [];
    grid.Answers_Array      = [];
    grid.Correct_Answers    = [];
    grid.text               = '';
    grid.link               = '';
    grid.Correct_Answer     = '';
    grid.Answer_Typ         = '';
    if(type==0)
      grid.Answer_Types      = ['اختيار واحد من متعدد','اختيار متعدد من متعدد','صح أم خطأ'];
    if(type==1)
      grid.Answer_Types      = ['اختيار واحد من متعدد','اختيار متعدد من متعدد','صح أم خطأ','نص','ملف'];
    grid.exam_type=type;
    url = 'Exam_Name_Index_Questions/' + id + '/edit';
    axios.get(url).then( function (response)  {
      grid.rows          = response.data.RecordData;
      grid.Exam_Index_Sum_Questions_Percents= response.data.percent_sum;
      grid.table_buttons = 'Exam_Name_Index_Questions';
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
                              label: 'درجة السؤال',
                              field: 'question_percent',
                              filterable: false,
                          },
                          {
                              label: 'السؤال',
                              field: 'text',
                              filterable: false,
                          }
                        ]
  },
  Fetch_Question_Types: function() {
      url = 'Question_Types.fetch';
      axios.get(url).then( function (response)  {
      grid.Question_Types = response.data.Question_Types;
    })
    
  },
  SetQuestionspercent: function(id) {
    grid.errors = [];
    url         = 'Exam_Name_Index_Questions/' + id + '/edit';
    grid.Exam_Name_Index_Id = id
    axios.get(url).then( function (response)  {
      grid.Questions = response.data.RecordData
      var Temporary_percent = (100 / grid.Questions.length) | 0
      var Sum_percent = 0
      $.each(grid.Questions, function( index, value ) {
        grid.percent[index] = Temporary_percent ;
        Sum_percent        += Temporary_percent;
      });
      Sum_percent = 100 - Sum_percent;
      grid.percent[0] += Sum_percent
      
    })
  },
    SetQuestionsorder: function(id) {
    grid.errors = [];
    url         = 'Exam_Name_Index_Questions/' + id + '/editOrder';
    grid.Exam_Name_Index_Id = id
    axios.get(url).then( function (response)  {
      grid.Questions = response.data.RecordData

      
    })
  },
	fetch: function() {
		grid.errors        = [];
    grid.table_buttons = 'Exam_Name_Index';
		url = 'Exam_Name_Index.fetch';
		axios.get(url).then( function (response)  {
	 
			grid.rows           = response.data.TableData;
      grid.Exam_Name      = response.data.Exam_Name;
      grid.Levels         = response.data.Levels;
      grid.Groups         = response.data.Groups;
      grid.Users          = response.data.Users;
		})
		grid.columns = [
                          
                          {
                              label: 'عمليات',
                              filterable: false,
                          },
                          {
                              label: 'حالة الامتحان',
                              filterable: false,
                          },
                          {
                              label: 'كود الامتحان',
                              field: 'code',
                              filterable: true,
                          },
                          {
                              label: 'نسبة الامتحان من 100',
                              field: 'exam_percent',
                              filterable: true,
                          },
                          {
                              label: 'مدة الامتحان',
                              field: 'period',
                              filterable: true,
                          },
                          {
                              label: 'تاريخ الامتحان',
                              field: 'date',
                              filterable: true,
                          },
                          {
                              label: 'اسم الامتحان',
                              field: 'exam__name.name',
                              filterable: true,
                          }
                        ]
    
    grid.Fetch_Question_Types();
	},
  Fetch_level_setting_exam_percent: function(id) {
    grid.errors             = [];
    grid.table_buttons      = 'level_setting_exam_percent';
    var url                 = 'level_setting_exam_percent/' + id + '/edit';      
    grid.exam_name_index_id = id
    this.insertingdata      = ({name : this.name})
    axios.get(url).then( function (response)  {
     
      grid.rows           = response.data.TableData;
      grid.Levels         = response.data.Levels;
     
    })
    grid.columns = [
                          
                          {
                              label: 'حذف',
                              filterable: false,
                          },
                          {
                              label: 'النسبة للاجتياز',
                              field: 'percent',
                              filterable: true,
                          },
                          {
                              label: 'المستوى',
                              field: 'level',
                              filterable: true,
                          },
                          {
                              label: 'اسم الامتحان',
                              field: 'exam__name.name',
                              filterable: true,
                          },
                          {
                              label: 'رقم الامتحان',
                              field: 'exam__name.id',
                              filterable: true,
                          }
                        ]
    
    grid.Fetch_Question_Types();
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
    	url = 'Exam_Name_Index/' + id + '/trash' 
    	axios.post(url)
		  .then(function (response) {
		  	grid.fetch();
		   
		  })
		  .catch(function (error) {
		    
		  });
		  }
    },
    trashQuestionData: function(id) {
      if (confirm('هل أنت متأكد أنك تريد حذف السؤال من الامتحان ؟؟؟')) {
      url = 'Exam_Name_Index_Questions/' + id + '/trash' 
      axios.post(url)
      .then(function (response) {
        grid.Get_Questions_data(grid.Exam_Name_Index_Id);
       
      })
      .catch(function (error) {
        
      });
      }
    },
		getdata: function(id) {
			url = 'Exam_Name/' + id + '/edit';
			axios.get(url).then( function (response)  {
				grid.id   = response.data.RecordData.id;
				grid.name = response.data.RecordData.name;
			})
		},
    getOneQuestionDetails: function(id) {
      grid.id=id;
      url = 'Exam_Name_Index_Questions/' + id ;
      axios.get(url).then( function (response)  {
      
        grid.id                = response.data.QuestionData.id;
        grid.Exam_Name_Index_Id= response.data.QuestionData.exam_name_index_id;
        grid.Question_Types_Id = {'label' :  response.data.QuestionType.name , 'value' :  response.data.QuestionType.id };
        grid.text              = response.data.QuestionData.text;
        grid.link              = response.data.QuestionData.link;
        grid.Correct_Answer    = response.data.QuestionData.correct_answer1;
        grid.Answers_Array     = [{'label' :  response.data.QuestionData.answer1 , 'value' :  response.data.QuestionData.answer1 },
                                  {'label' :  response.data.QuestionData.answer2 , 'value' :  response.data.QuestionData.answer2 },
                                  {'label' :  response.data.QuestionData.answer3 , 'value' :  response.data.QuestionData.answer3 },
                                  {'label' :  response.data.QuestionData.answer4 , 'value' :  response.data.QuestionData.answer4 }
                                 ];
        grid.Correct_Answers   = [{'label' :  response.data.QuestionData.correct_answer1 , 'value' :  response.data.QuestionData.correct_answer1 },
                                  {'label' :  response.data.QuestionData.correct_answer2 , 'value' :  response.data.QuestionData.correct_answer2 },
                                  {'label' :  response.data.QuestionData.correct_answer3 , 'value' :  response.data.QuestionData.correct_answer3 }
                                 ];
        grid.Answer_Type       = response.data.QuestionData.answer_type;
        grid.question_percent  = response.data.QuestionData.question_percent;
        
      })
    },
    updateQuestionPercent: function() {
    var url = 'Exam_Name_Index_Questions_Percent'  ;
    this.insertingdata = ({
                            Questions : grid.Questions,
                            id        : grid.Exam_Name_Index_Id  
                         })
    axios.post( url , this.insertingdata)
      .then(function(response){
        
        grid.table_buttons = 'Exam_Name_Index_Questions';
        $('#Close_updateQuestionPercent').trigger('click');
       
        grid.Get_Questions_data(grid.Exam_Name_Index_Id,grid.exam_name_label,grid.exam_index_percent);
      })
      .catch(function(response){
        
      });
    }, 
	updateQuestionOrder: function() {
    var url = 'Exam_Name_Index_Questions_Order'  ;
    this.insertingdata = ({
                            Questions : grid.Questions,
                            id        : grid.Exam_Name_Index_Id  
                         })
    axios.post( url , this.insertingdata)
      .then(function(response){
        
        grid.table_buttons = 'Exam_Name_Index_Questions';
        $('#Close_updateQuestionOrder').trigger('click');
       
        grid.Get_Questions_data(grid.Exam_Name_Index_Id,grid.exam_name_label,grid.exam_index_percent);
      })
      .catch(function(response){
        
      });
    },
    updateQuestionDetails: function() {
    var url = 'Exam_Name_Index_Questions/' + grid.id ;
    this.insertingdata = ({
                            exam_name_index_id : grid.Exam_Name_Index_Id,
                            Question_Types_Id  : grid.Question_Types_Id["value"], 
                            text               : grid.text,
                            answers            : grid.Answers_Array,
                            correct_answer     : grid.Correct_Answer,
                            question_percent   : grid.question_percent,
                            link               : grid.link,
                            file               : grid.file,
                            answer_type        : grid.Answer_Type,
                            correct_answers    : grid.Correct_Answers,
                            correct_answer1    : grid.Correct_Answer
                         })
    axios.put( url , this.insertingdata)
      .then(function(response){
     
        grid.table_buttons = 'Exam_Name_Index_Questions';
        $('#Close_Update_Exam_Index_Questions').trigger('click');
        
        
        grid.Get_Questions_data(grid.Exam_Name_Index_Id,grid.exam_name_label,grid.exam_index_percent,grid.exam_type);
      })
      .catch(function(response){
        
      });
    },
    getExamIndexdata: function(id) {
      url = 'Exam_Name_Index/' + id + '/edit';
      axios.get(url).then( function (response)  {
        grid.Exam_Type    = response.data.RecordData.exam_type;
        grid.id           = response.data.RecordData.id;
        grid.Exam_Name_Id = {'label' :  response.data.Foreign.name , 'value' :  response.data.Foreign.id };
        grid.date         = response.data.RecordData.date;
        grid.period       = response.data.RecordData.period;
        grid.percent      = response.data.RecordData.exam_percent;
      })
    },
    updateExamIndex: function() {
      var url = 'Exam_Name_Index/' + grid.id ;
      this.insertingdata = ({
                             exam_name_id : this.Exam_Name_Id["value"],
                             date : this.date,
                             period : this.period,
                             exam_percent : this.percent,
                             exam_type: this.Exam_Type

                           })
      axios.put(url ,  this.insertingdata)
        .then(function (response) {
        
          if(response.data.errors)
          {
            grid.errors = response.data.errors

          }
          else
          {
            $('#Close_Update_Exam_Index').trigger('click');
            grid.fetch();
          }
          
        })
        .catch(function (error) {
        });
    },
     handleFileUpload() {
    
      this.file = this.$refs.UploadFile.files[0];
    },
    
    
},
mounted(){
    $(this.$refs.vuemodal).on("hidden", this.fetch);
    $(this.$refs.updatevuemodal).on("hidden", this.fetch);
    
  }
})

grid.fetch();


