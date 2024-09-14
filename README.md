

<h1 align="center">Survey Management System</h1>

#### We designed this system for introduce local products from Taungoo Region. Accepting local products by using this project and to analyse which are good.


## System Requirement
- PHP -8.0
- Laravel-9
- Tailwind Css

## Installation

### :zap:Clone the repo to your server 
Clone this project in your folder by using this command

```bash
  git clone https://github.com/CGMHeinHtet/Survey-Management-System.git
```
 [SurveyForm_Backend_TgoUC2022](https://github.com/CGMHeinHtet/Survey-Management-System.git)
### :zap:Run composer, npm
Need to run composer and some commands
```bash
  composer installation
  npm install
  npm run dev
  php artisan storage:link
  php artisan migrate:fresh --seed
  php artisan serve
```

##  Set up env file
#### :zap: Database set up
Make your database set up in .env file
```bash
  DB_DATABASE=survey_db
  DB_USERNAME=
  DB_PASSWORD=
```
#### :zap:  Sparkpost set up for mailing system
We used [sparkpost](https://www.sparkpost.com/) malling system in this project. If you don't have it, you can use [mailtrap](https://mailtrap.io/) or any other local mailing system.
```bash
  MAIL_MAILER=sparkpost
  MAIL_HOST=smtp.sparkpost.org
  MAIL_USERNAME=
  MAIL_PASSWORD=
  MAIL_ENCRYPTION=
  MAIL_FROM_ADDRESS=
  SPARKPOST_SECRET=
  MAILGUN_DOMAIN=
  MAILGUN_SECRET=
```
## Package
Used those package for some services
- [Flowbite](https://flowbite.com/)
- [OpenStreetMap](https://www.openstreetmap.org/s)
- [Chart Js](https://www.chartjs.org/)
- [Larvel Excel](https://laravel-excel.com/)

## Components
#### Controllers
<ol>  
<li>Api</li>  
<ol>  
	<li>CategoryApiController</li>  
	<li>NoteApiController</li>  
	<li>StaffApiController</li>  
	<li>SurveyApiController</li> 
</ol>  
<li>Manager</li>  
<ol>  
	<li>Survey</li>  
	<ol>  
		<li>SurveyController</li> 
	</ol>  
	<li>Staff</li>  
	<ol>  
		<li>StaffController</li> 
	</ol>  
	<li>Report</li>  
	<ol>  
		<li>ReportController</li> 
	</ol>  
	<li>ManagerController</li>  
	</ol>  
	<li>BaseController</li>  
</ol>

### Middleware
- PreventBackHistory
- RecentRouteMiddleware
- StaffMiddleware

### Resources
- NoteResource
- StaffResource
- SurveyResource

### Mail
- ForgetPassword

### Rules
- CheckCategoryDataDuplicate

### Routes
- api_note
- api_survey


## Tables in this project
Using MySql database, created 5 migration files and 5 models
```bash
+------------------------+
| Tables_in_survey_db    |
+------------------------+
| categories             |
| failed_jobs            |
| managers               |
| migrations             |
| notes                  |
| password_resets        |
| personal_access_tokens |
| staff                  |
| surveys                |
| users                  |
+------------------------+
```

## Flowchart
Manager သည် login form မှာတဆင့် Home Page ဆီသို့၀င်ပါမည်<br>Sidebar မှတစ်ဆင့်လဲ ၀င်ရောက်နိုင်ပြီး Sidebar တွင် Surveys, Staff, Report and Dashboard ဆိုပြီး 4 ခုရှိပါမည်

![alt text](https://surveybc.zacompany.dev//storage/images/flowchart.png)

#### Surveys Page
- Surveys Page တွင် Tabs 3 ခုရှိပြီး Pending, Selected, Rejected တို့ပါ၀င်ပါမည်
- Pending Tab တွင် ရရှိထားသော Survey Data များကို Date အလိုက်ပြသထားမှာဖြစ်ပြီး
- Survey data list တွင် business name and surver name များကို submitted date များအလိုက် ပြသထားမှာဖြစ်ပါတယ်
- Data များကို Detail ၀င်ကြည့်လို့ရမှာဖြစ်ပြီး remark များမှာလဲ up to date ဖြစ်နေမှာဖြစ်ပါတယ်
- Data များကို Manager မှ Data တစ်ခုချင်းစီအလိုက် Accept or Reject လုပ်ခွင့်ရှိပါမည်
- Accepted data များကိုလဲ reject ပြန်လုပ်နိုင်မှာဖြစ်ပြီး Rejected data များကိုလဲ Restore to Pending လုပ်နိုင်မှာဖြစ်ပါတယ်
- Manager မှလဲ Survey Data များကို Detail မှတဆင့် မိမိကိုယ်ပိုင် remark ပြုလုပ်လို့ရပါမည်

![alt text](https://surveybc.zacompany.dev/storage/images/survey.png)

### Staff Page
- Staff Page တွင် Staff အသစ်များ Register ပြုလုပ်ခြင်း  
- လက်ရှိ Staffs များရဲ့ data များပြုပြင် ပြောင်းလဲခြင်း  
- Staffs များကိုလဲ Suspend လုပ်ခြင်း စသည့်လုပ်ငန်းစဥ်များ ပါ၀င်ပါမည်  
- Staff Data များ ကိုလဲ Row အလိုက် Update ပြုလုပ်နိုင်ပြီး Permission များလဲ ပြောင်းလဲနိုင်မှာဖြစ်ပါတယ်  
- Permission တွင် Staff မှ Supervisor Or Supervisor မှ Staff စသကဲ့သို့ Permission များ ပါ၀င်ပါမည်

![alt text](https://surveybc.zacompany.dev/storage/images/staff.png)

### Report Page
- Report Page တွင် နေ့အလိုက် Survey Data များကို  
No, Survey Date, Business Name, Owner Name, Phone Number, Township, Surver Name စသည်ဖြင့်ပြသပေးမှာဖြစ်ပါသည်
