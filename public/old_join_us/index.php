<?php


//echo "<script>alert('املأ جميع الحقول قبل التسجيل')</script>";
//header('location:index.php');

///////////////////////////////////////////////
//   When the submit button is pressed       //
///////////////////////////////////////////////
if(isset($_POST["submit"]))
{
  $Volunteer_First_Name=$_POST["First_Name"];
  $Volunteer_Family_Name=$_POST["Family_Name"];
  $Volunteer_Father_Name=$_POST["Father_Name"];
  $Volunteer_Date_Of_Birth=$_POST["Date_Of_Birth"];
  $Volunteer_Current_Country=$_POST["Current_Country"];
  $Volunteer_Current_City=$_POST["Current_City"];
  $Volunteer_Nationality=$_POST["Nationality"];
    
  $Volunteer_Phone_Number=$_POST["Phone_Number"];
  $Volunteer_Email=$_POST["Email"];
  $Volunteer_Facebook_Page=$_POST["Facebook_Page"];
  
  $Volunteer_Degree=$_POST["Degree"];
  $Volunteer_Specialization=$_POST["Specialization"];
  $Volunteer_University=$_POST["University"];
  $Volunteer_English_Level=$_POST["English_Level"];
  
  $Volunteer_Position=$_POST["Position"];
  $Volunteer_Companyt=$_POST["Company"];

  $Volunteer_Department=$_POST["Department"];
  $Volunteer_Department_Reason=$_POST["Department_Reason"];
  $Volunteer_Voluntary_Reason=$_POST["Voluntary_Reason"];
  $Volunteer_Six_Months=$_POST["Six_Months"];

  // include database connector
  require('DB/DB.php');
  $db=new DB();
  $Query="INSERT INTO volunteer_requests(first_name,family_name,father_name,d_o_birth,country,city,nationality,phone_no,email,fb_link,degree,specialty,uni_name,english_level,position,company,department_name,dept_reason,voluntary_reason,six_months) 
  VALUES ('$Volunteer_First_Name','$Volunteer_Family_Name','$Volunteer_Father_Name','$Volunteer_Date_Of_Birth','$Volunteer_Current_Country','$Volunteer_Current_City','$Volunteer_Nationality','$Volunteer_Phone_Number','$Volunteer_Email','$Volunteer_Facebook_Page','$Volunteer_Degree','$Volunteer_Specialization','$Volunteer_University','$Volunteer_English_Level','$Volunteer_Position','$Volunteer_Companyt','$Volunteer_Department','$Volunteer_Department_Reason','$Volunteer_Voluntary_Reason','$Volunteer_Six_Months')";

  $check=$db->query($Query);


  // check is boolean equals to FALSE in case of error ,or integer in case of success
  if($check)
  {
    //  action is here! (SUCCESS)
    unset($_POST["submit"]);
    header('location:success.php');



  }
  else
  {
    //  action is here ! (FAILURE)
    
    header('location:index.php');

  }

  
  

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Join Utopians</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- LINEARICONS -->
  <link rel="stylesheet" href="fonts/linearicons/style.css">

  <!-- STYLE CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cabin" />
  <link rel="icon" href="logo.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="logo.ico" type="image/x-icon" />
  <style>body{ font-family: Times New Roman} label{color:#00425F} </style>
</head>

<body>

  <div class="wrapper rtl" id="wrapper">
    <div class="inner">
        <div class="navbar">
            <div style="float:left;letter-spacing: 10px;">UTOPIANS</div>
            <ul>
              <li id="ar_click" class="button_lang current_lang">ع</li>
              <li id="en_click" class="button_lang">En</li>
            </ul>
        </div>
      <form action="" method="POST">
        <p style="text-align: center;"><img src="logo.png" height="150"></p>
        <h3 id="ar">نـمـــوذج الـتـطــوع</h3>
        <h3 id="en">Volunteering Form</h3>
        <div class="section">
            <div class="first_section">
                <div id="ar" class="section_name">  أولاً: المعلومات الشخصية </div> 
                <div id="en" class="section_name">  First: Personal Information </div> 
                <div class="form-holder">
                  <label id="ar"><b>  الاسم </b></label>
                  <label id="en"><b>  First Name: </b></label>
                  <span class="lnr lnr-user"></span>
                  <input type="text" class="form-control" id="first_name" name="First_Name" required>
                </div>
                <div class="form-holder">
                  <label id="ar"><b>  اسم العائلة</b></label>
                  <label id="en"><b> Last Name:</b></label>
                  <span class="lnr lnr-user"></span>
                  <input type="text" class="form-control" id="family_name" name="Family_Name" required>
                </div>
                <div class="form-holder">
                  <label id="ar"><b>  اسم الأب</b></label>
                  <label id="en"><b>  Father's name:</b></label>
                  <span class="lnr lnr-user"></span>
                  <input type="text" class="form-control"  id="father_name" name="Father_Name" required>
                </div>
                <div class="form-holder">
                  <label id="ar"><b>  تاريخ الميلاد</b></label>
                  <label id="en"><b>  Date of Birth:</b></label>
                  <span class="lnr lnr-calendar-full"></span>
                  <input type="date" class="form-control"  id="date_birth" name="Date_Of_Birth" required>
                </div>
                <div class="form-holder">
                  <label id="ar"><b>بلد الإقامة: (مثال: سوريا، فلسطين، ..)</b></label>
                  <label id="en"><b>  Country of residence: (Ex: Syria, Cairo, .. )</b></label>
                  <span class="lnr  lnr-map-marker"></span>
                  <input type="text" class="form-control" name="Current_Country" required>
                </div>
                <div class="form-holder">
                  <label id="ar"><b>  اسم المدينة: (مثال: دمشق، حمص، القاهرة ...)</b></label>
                  <label id="en"><b>  City: (Ex: Aleppo, Homs, .. )</b></label>
                  <span class="lnr  lnr-map-marker"></span>
                  <input type="text" class="form-control" name="Current_City" required>
                </div>
                <div class="form-holder">
                  <label id="ar"><b>  الجنسية: (مثال: سوري، فلسطيني، ..)</b></label>
                  <label id="en"><b>  Nationality: (Ex: Syrian, Egyption, ..)</b></label>
                  <span class="lnr lnr-frame-expand"></span>
                  <input type="text" class="form-control" name="Nationality" required>
                </div>  
            </div>  
        </div>
          
        <div class="section">
            <div class="second_section">
                <div id="ar" class="section_name"> ثانياً: معلومات الاتصال </div>
                <div id="en" class="section_name"> Second: Contact Information </div>
                <div class="form-holder">
                  <label id="ar"><b>رقم الموبايل: (مثال: 00963935740646)</b></label>
                  <label id="en"><b>  Mobile Number: (Ex: 00963935740646) </b></label>
                  <span class="lnr lnr-phone-handset"></span>
                  <input type="text" class="form-control" name="Phone_Number" required>
                </div>
                <div class="form-holder">
                  <label id="ar"><b>  عنوان البريد الإلكتروني</b> </label>
                  <label id="en"><b>  Email Address:</b> </label>
                  <span class="lnr lnr-envelope"></span>
                  <input type="email" class="form-control" name="Email" required>
                </div>
                <div class="form-holder">
                  <label id="ar"><b>  رابط صفحتك الشخصية على فيسبوك</b></label>
                  <label id="en"><b>  Facebook Profile Link: </b></label>
                  <span class="fab fa-facebook"></span>
                  <input type="text" class="form-control" name="Facebook_Page" required>
                </div>
            </div>
        </div>
          
        <div class="section">
            <div class="third_section">
                <div id="ar" class="section_name"> ثالثاً: المعلومات الأكاديمية </div>
                <div id="en" class="section_name"> Third: Academic Information </div>
                <div class="form-holder">
                  <label id="ar"><b>أخر شهادة علمية حاصل عليها</b> </label>
                  <label id="en"><b> What is your highest level of education?</b> </label>
                  <select class="form-control" id="degrees" name="Degree" required>
                    <option hidden style='display: none'></option>
                    <option id="ar" value="شهادة المرحلة الاعدادية">شهادة المرحلة الاعدادية</option>
                    <option id="ar" value="الشهادة الثانوية">الشهادة الثانوية</option>
                    <option id="ar" value="درجة الدبلوم">درجة الدبلوم</option>
                    <option id="ar" value="درجة البكالوريوس">درجة البكالوريوس</option>
                    <option id="ar" value="درجة الماجستير">درجة الماجستير</option>
                    <option id="ar" value="درجة الدكتوراه">درجة الدكتوراه</option>
                    <option id="en" value="Middle School">Middle School</option>
                    <option id="en" value="High School">High School</option>
                    <option id="en" value="Diploma Degree">Diploma Degree</option>
                    <option id="en" value="Bachelor’s Degree">Bachelor’s Degree</option>
                    <option id="en" value="Master’s Degree">Master’s Degree</option>
                    <option id="en" value="PhD Degree">PhD Degree</option>
                  </select>
                </div>
                <div class="form-holder">
                  <label id="ar"><b>  التخصص الدراسي (مثال: اقتصاد) </b></label>
                  <label id="en"><b>  The field of study: (Ex: Economy) </b></label>
                  <span class="lnr lnr-pencil"></span>
                  <input type="text" class="form-control" name="Specialization" required>
                </div>
                <div class="form-holder">
                  <label id="ar"><b>  اسم الجامعة، المعهد، المدرسة، الأكاديمية (مثال: جامعة دمشق،) </b></label>
                  <label id="en"><b> University, Institute, School (Ex: Damascus University)  </b></label>
                  <span class="lnr lnr-apartment"></span>
                  <input type="text" class="form-control" name="University" required>
                </div>
                <div class="form-holder">
                  <label id="ar"><b>  مستوى اللغة الانجليزية </b></label>
                  <label id="en"><b>  English language level </b></label>
                    <br>
                  <div class="lang">
                    <label id="ar">لا يوجد</label>
                    <label id="en">None</label>
                    <label for="0">0<br />
                    <input type="radio" id="0" name="English_Level" value="0" required />
                    </label>
                    <label for="1">1<br />
                    <input type="radio" id="1" name="English_Level" value="1" />
                    </label>
                    <label for="2">2<br />
                        <input type="radio" id="2" name="English_Level" value="2" />
                    </label>
                    <label for="3">3<br />
                        <input type="radio" id="3" name="English_Level" value="3" />
                    </label>
                    <label for="4">4<br />
                        <input type="radio" id="4" name="English_Level" value="4" />
                    </label>
                    <label for="5">5<br />
                        <input type="radio" id="5" name="English_Level" value="5" />
                    </label>
                    <label for="6">6<br />
                        <input type="radio" id="6" name="English_Level" value="6" />
                    </label>
                    <label id="ar">طليق</label>
                    <label id="en">fluent</label>
                  </div>
                </div>
            </div>
        </div>
          
        <div class="section">
            <div class="forth_section">
                <div id="ar" class="section_name"> رابعاً: الخبرة </div>
                <div id="en" class="section_name"> Fourth: Experience </div>
                <div class="form-holder">
                    <label id="ar"><b> المنصب الوظيفي: (مثال: مساعد موارد بشرية) </b></label>
                    <label id="en"><b> Job position: (Ex: Human Resources Assistant)  </b></label>
                    <span class="lnr lnr-user"></span>
                    <input type="text" class="form-control" name="Position" required>
                </div>
                <div class="form-holder">
                    <label id="ar"><b>  اسم الشركة، المنظمة، المؤسسة التي عملت أو تطوعت بها</b></label>
                    <label id="en"><b>  Organization / company </b></label>
                    <span class="lnr lnr-frame-expand"></span>
                    <input type="text" class="form-control" name="Company" required>
                </div>
            </div>
        </div>
          
        <div class="section">
            <div class="fifth_section">
              <div id="ar" class="section_name"> خامساً: التطوع </div>
              <div id="en" class="section_name"> Fifth: Volunteering  </div>
                  <div class="form-holder">
                      <label id="ar"><b>  القسم المرغوب للتطوع</b> </label>
                      <label id="en"><b>  Desired Department</b> </label>
                      <select class="form-control" name="Department" id="departments" required>
                        <option hidden style='display: none'></option>
                        <option id="ar" value="قسم المدرسين">قسم المدرسين</option>
                        <option id="ar" value="قسم تطوير المناهج">قسم تطوير المناهج</option>
                        <option id="ar" value="قسم التنسيق">قسم التنسيق</option>
                        <option id="ar" value="قسم شؤون الطلاب">قسم شؤون الطلاب</option>
                        <option id="ar" value="قسم التصميم">قسم التصميم</option>
                        <option id="ar" value="قسم تكنولوجيا المعلومات">قسم تكنولوجيا المعلومات</option>
                        <option id="ar" value="قسم التسويق والعلاقات العامة">قسم التسويق والعلاقات العامة</option>
                        <option id="ar" value="قسم الموارد البشرية">قسم الموارد البشرية</option>
                        <option id="en" value="Teachers Dept.">Teachers Dept.</option>
                        <option id="en" value="Curriculum Development Dept.">Curriculum Development Dept.</option>
                        <option id="en" value="Coordinating Dept.">Coordinating Dept.</option>
                        <option id="en" value="Student Affairs Dept.">Student Affairs Dept.</option>
                        <option id="en" value="Design Dept.">Design Dept.</option>
                        <option id="en" value="Technical Information Dept.">Technical Information Dept.</option>
                        <option id="en" value="Marketing & Public Relation Dept.">Marketing & Public Relation Dept.</option>
                        <option id="en" value="HR Dept.">HR Dept.</option>
                      </select>
                </div>
                <div class="form-holder">
                    <label id="ar"><b>  لماذا قمت باختيار هذا القسم؟ </b></label>
                    <label id="en"><b>  Why did you choose this department?</b></label>
                    <span class="lnr  lnr-indent-increase"></span>
                    <input type="text" class="form-control" name="Department_Reason" required>
                </div>
                <div class="form-holder">
                    <label id="ar"><b> لماذا ترغب التطوع في المبادرة؟ </b></label>
                    <label id="en"><b> Why do you wish to volunteer with Utopians? </b></label>
                    <span class="lnr  lnr-indent-increase"></span>
                    <input type="text" class="form-control" name="Voluntary_Reason" required>
                </div>
                
                <div class="form-holder">
                  <label id="ar"><b>هل يمكنك الالتزام بالتطوع لمدة ستة أشهر على الأقل؟</b></label><br>
                  <label id="en"><b>Can you commitment for at least 6 months?   </b></label>
                      <select class="form-control" name="Six_Months" required>
                        <option hidden style='display: none'></option>
                        <option id="ar" value="نعم">نعم</option>
                        <option id="ar" value="لا">لا</option>
                        <option id="en" value="yes">Yes</option>
                        <option id="en" value="no">No</option>
                      </select>
                </div>
                        
            </div>
        </div>
              
      <button input type="submit" name="submit" value="submit">
        <span id="ar"><b>تسجيل</b></span>
        <span id="en">SUBMIT</span>
      </button>
    </form>
    <!--<img src="images/image-2.png" alt="" class="image-2">-->
  </div>

</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/main.js"></script>
<script src="js/lang.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>