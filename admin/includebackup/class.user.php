<?php
require_once 'dbconfig.php';
class USER
{	
	private $conn;
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($fname,$lname,$email,$password,$phone,$dob,$company,$address1,$address2,$city,$state,$pincode,$newsletter,$code,$bannerpic,$pic,$role)
	{
		try
		{						
			$password = md5($password);
			$stmt = $this->conn->prepare("INSERT INTO tbl_admin_customers(cusFname,cusLname,cusEmail,cusPassword,cusPhone,cusDob,cusCompany,cusAddress1,cusAddress2,cusCity,cusState,cusPincode,cusNewsletter,cusCode,cusBannerpic,cusPic,role) 
			                                             VALUES(:cusFname, :cusLname, :cusEmail, :cusPassword, :cusPhone, :cusDob, :cusCompany, :cusAddress1, :cusAddress2, :cusCity, :cusState, :cusPincode, :cusNewsletter, :cusCode, :cusBannerpic, :cusPic, :role)");
			$stmt->bindparam(":cusFname",$fname);
			$stmt->bindparam(":cusLname",$lname);
			$stmt->bindparam(":cusEmail",$email);
			$stmt->bindparam(":cusPassword",$password);
			$stmt->bindparam(":cusPhone",$phone);
			$stmt->bindparam(":cusDob",$dob);
			$stmt->bindparam(":cusCompany",$company);
			$stmt->bindparam(":cusAddress1",$address1);
			$stmt->bindparam(":cusAddress2",$address2);
			$stmt->bindparam(":cusCity",$city);
			$stmt->bindparam(":cusState",$state);
			$stmt->bindparam(":cusPincode",$pincode);
			$stmt->bindparam(":cusNewsletter",$newsletter);
			$stmt->bindparam(":cusCode",$code);
			$stmt->bindparam(":cusBannerpic",$bannerpic);
			$stmt->bindparam(":cusPic",$pic);
			$stmt->bindparam(":role",$role);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM tbl_admin_customers WHERE cusEmail=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['cusStatus']=="Y")
				{
					if($userRow['cusPassword']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['id'];
						return true;
					}
					else
					{
						$_SESSION['userPasswordWrong'] = "Password dint matched with the given email id";
						header("Location: login");
						exit;
					}
				}
				else
				{
					$_SESSION['userInactive'] = "User is inactive we have sent a email please check to active.";
					header("Location: login");
					exit;
				}	
			}
			else
			{
				$_SESSION['userNotExist'] = "User not found please register as new user";
				header("Location: login");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
			require_once('mailer/class.phpmailer.php');
			$mail = new PHPMailer();
			$mail->IsSMTP(); 
			                 
			$mail->SMTPAuth   = true;                  
			$mail->SMTPSecure = "ssl";                 
			$mail->Host       = "smtp.gmail.com";      
			$mail->Port       = 465;             
			$mail->AddAddress($email);
			$mail->Username="support@worldvisioncable.in";  
			$mail->Password="support@123";            
			$mail->SetFrom('support@worldvisioncable.in','Worldvisioncable');
			$mail->AddReplyTo("support@worldvisioncable.in","Worldvisioncable");
			$mail->Subject    = $subject;
			$mail->MsgHTML($message);
			$mail->Send();
	}

	public function cities($city)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM cities WHERE state_id=:state_id");
			$stmt->execute(array(":state_id"=>$city));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				return $stmt;
			}		
				
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}



	public function addemp($emp_fname, $emp_lname, $emp_email, $emp_phone, $emp_dob, $emp_address1, $emp_address2,$emp_state, $emp_city, $emp_role,$emp_profileimg1,$emp_bannerimg1, $emp_pincode, $emp_id, $emp_designation, $emp_doj, $emp_accno,$emp_gender, $emp_department,$emp_qualification,$emp_marital,$emp_panno, $emp_code)
		{
			try
			{

				$stmt = $this->conn->prepare("INSERT INTO tbl_employee(empFname, empLname, empEmail, empPhone, empDob, empAddress1,empAddress2, empState, empCity, empRole, empProfileimg,empBannerimg,empPincode, empID, empDesignation, empDoj, empAccno, empGender,empDepartment, empQualification,empMarital,empPanno,empCode) 
					VALUES(:empFname, :empLname, :empEmail, :empPhone, :empDob,:empAddress1, :empAddress2, :empState, :empCity, :empRole, :empProfileimg,:empBannerimg,:empPincode, :empID, :empDesignation, :empDoj, :empAccno, :empGender,:empDepartment, :empQualification,:empMarital,:empPanno, :empCode)");
				$stmt->bindparam(":empFname",$emp_fname);
				$stmt->bindparam(":empLname",$emp_lname);
				$stmt->bindparam(":empEmail",$emp_email);
				$stmt->bindparam(":empPhone",$emp_phone);
				$stmt->bindparam(":empDob",$emp_dob);
				$stmt->bindparam(":empAddress1",$emp_address1);
				$stmt->bindparam(":empAddress2",$emp_address2);
				$stmt->bindparam(":empState",$emp_state);
				$stmt->bindparam(":empCity",$emp_city);
				$stmt->bindparam(":empRole",$emp_role);
				$stmt->bindparam(":empProfileimg",$emp_profileimg1);
				$stmt->bindparam(":empBannerimg",$emp_bannerimg1);
				$stmt->bindparam(":empPincode",$emp_pincode);
				$stmt->bindparam(":empID",$emp_id);
				$stmt->bindparam(":empDesignation",$emp_designation);
				$stmt->bindparam(":empDoj",$emp_doj);
				$stmt->bindparam(":empAccno",$emp_accno);
				$stmt->bindparam(":empGender",$emp_gender);
				$stmt->bindparam(":empDepartment",$emp_department);
				$stmt->bindparam(":empQualification",$emp_qualification);
				$stmt->bindparam(":empMarital",$emp_marital);
				$stmt->bindparam(":empPanno",$emp_panno);
				$stmt->bindparam(":empCode",$emp_code);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}

	public function postAd($ad_doneby,$ad_title, $ad_keywords, $ad_cat_id, $ad_sub_cat_id, $ad_plan, $apotherPlan, $cus_name, $cus_type, $cus_phone,$ad_landline, $cus_email, $ad_address,$ad_address2,$ad_landmark,$ad_landmark2, $ad_state, $ad_city, $ad_area, $ad_pincode, $ad_url, $ad_description,$ad_serviceoffer, $images1, $ad_code, $url, $meta_title, $meta_description, $meta_keywords, $ad_alsolisted,$apStatus)
		{
			try
			{

				$stmt = $this->conn->prepare("INSERT INTO tbl_ads_posted(apDoneby,apTitle, apKeywords, apCategoryId, apSubCategoryId, apPlan, apotherPlan, apCusName, apCusType, apCusPhone, apCusLandline, apCusEmail, apAddress,apAddress2,apLandmark,apLandmark2, apState, apCity, apArea, apPincode, apCompanyUrl, apDescription,apServiceoffer, apImages, apCode, apUrl, apMetaTitle, apMetaDescription, apMetaKeywords, apAlsolisted, apStatus) 
					VALUES(:apDoneby,:apTitle, :apKeywords, :apCategoryId, :apSubCategoryId, :apPlan, :apotherPlan, :apCusName, :apCusType, :apCusPhone, :apCusLandline, :apCusEmail, :apAddress,:apAddress2,:apLandmark,:apLandmark2, :apState, :apCity, :apArea, :apPincode, :apCompanyUrl, :apDescription,:apServiceoffer, :apImages, :apCode, :apUrl, :apMetaTitle, :apMetaDescription, :apMetaKeywords, :apAlsolisted, :apStatus)");
                                $stmt->bindparam(":apDoneby",$ad_doneby);
				$stmt->bindparam(":apTitle",$ad_title);
				$stmt->bindparam(":apKeywords",$ad_keywords);
				$stmt->bindparam(":apCategoryId",$ad_cat_id);
				$stmt->bindparam(":apSubCategoryId",$ad_sub_cat_id);
				$stmt->bindparam(":apPlan",$ad_plan);
				$stmt->bindparam(":apotherPlan",$apotherPlan);
				$stmt->bindparam(":apCusName",$cus_name);
				$stmt->bindparam(":apCusType",$cus_type);
				$stmt->bindparam(":apCusPhone",$cus_phone);
				$stmt->bindparam(":apCusLandline",$ad_landline);
				$stmt->bindparam(":apCusEmail",$cus_email);
				$stmt->bindparam(":apAddress",$ad_address);
				$stmt->bindparam(":apAddress2",$ad_address2);
				$stmt->bindparam(":apLandmark",$ad_landmark);
				$stmt->bindparam(":apLandmark2",$ad_landmark2);
				$stmt->bindparam(":apState",$ad_state);
				$stmt->bindparam(":apCity",$ad_city);
				$stmt->bindparam(":apArea",$ad_area);
				$stmt->bindparam(":apPincode",$ad_pincode);
				$stmt->bindparam(":apCompanyUrl",$ad_url);
				$stmt->bindparam(":apDescription",$ad_description);
				$stmt->bindparam(":apServiceoffer",$ad_serviceoffer);
				$stmt->bindparam(":apImages",$images1); 
				$stmt->bindparam(":apCode",$ad_code);
				$stmt->bindparam(":apUrl",$url);
				$stmt->bindparam(":apMetaTitle",$meta_title);
				$stmt->bindparam(":apMetaDescription",$meta_description);
				$stmt->bindparam(":apMetaKeywords",$meta_keywords);
$stmt->bindparam(":apAlsolisted",$ad_alsolisted);
$stmt->bindparam(":apStatus",$apStatus);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		} 


		public function AddAppointment($ad_doneby, $bus_name, $keywords, $cus_name, $cus_phone, $cus_email, $ad_address, $ad_plan, $Other_amt, $ad_landmark, $appfor, $webpage, $appointment_date, $appointment_time, $appointment_Comments)
		{
			try{
				$stmt = $this->conn->prepare("INSERT INTO tbl_appointment(Created_by, Business_Name, Keywords, Cus_Name, Phone, Email, Address, Plan, Other_amt, Landmark, Appfor, Webpage, Appoinment_date, Appointment_time, Comments, Mode_of_Payment,Cheque_Num, Collected_Date, Amount_Collected, Status, Modified_by, ip) 
					VALUES('$ad_doneby','$bus_name','$keywords', '$cus_name', '$cus_phone', '$cus_email', '$ad_address', '$ad_plan', '$Other_amt', '$ad_landmark', '$appfor', '$webpage', '$appointment_date', '$appointment_time', '$appointment_Comments', '','', '', '', 'Pending', '', '')");
				$stmt->execute();	
				return $stmt;
				
			}
			catch(PDOException $ex){
				echo $ex->getMessage();
			}
		}
		
			public function Addpause($postid, $pausedate, $pausereason)
		{
			try{
				$stmt = $this->conn->prepare("INSERT INTO web_pause(postid, pausedate, pausereason) 
					VALUES('$postid','$pausedate','$pausereason')");
				$stmt->execute();	
				return $stmt;
				
			}
			catch(PDOException $ex){
				echo $ex->getMessage();
			}
		}
		
		public function Addlead($cus_name, $cus_phone, $cus_email, $cus_address, $cus_comments, $latitude, $longitude, $created_by)
		{
			try{
			$ipaddress = '';
    		if (isset($_SERVER['HTTP_CLIENT_IP'])){
        		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    		}
    		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    		}
    		else if(isset($_SERVER['HTTP_X_FORWARDED'])){
        		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    		}
    		else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
        		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    		}
    		else if(isset($_SERVER['HTTP_FORWARDED'])){
        		$ipaddress = $_SERVER['HTTP_FORWARDED'];
    		}
    		else if(isset($_SERVER['REMOTE_ADDR'])){
        		$ipaddress = $_SERVER['REMOTE_ADDR'];
    		}
    		else{
        		$ipaddress = 'UNKNOWN';
    		}
				$stmt = $this->conn->prepare("INSERT INTO tbl_lead_generation(cus_name, cus_phone, cus_email, cus_address, cus_comments, latitude, longitude, created_by,ip) 
					VALUES('$cus_name', '$cus_phone', '$cus_email', '$cus_address','$cus_comments', '$latitude', '$longitude', '$created_by','$ipaddress')");
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex){
				echo $ex->getMessage();
			}
		}



	public function addCategory($cat_name, $cat_image, $cat_icon,$cat_url)
		{
			try
			{

				$stmt = $this->conn->prepare("INSERT INTO tbl_categories(categoryName, categoryimage, categoryicon, categoryUrl) 
					VALUES(:categoryName, :categoryimage, :categoryicon, :categoryUrl)");
				$stmt->bindparam(":categoryName",$cat_name);
				$stmt->bindparam(":categoryimage",$cat_image);
				$stmt->bindparam(":categoryicon",$cat_icon);
				$stmt->bindparam(":categoryUrl",$cat_url);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}

		public function addSubcategory($subcat_name, $cat_id, $cat_img,$subcat_url)
		{
			try
			{
				$stmt = $this->conn->prepare("INSERT INTO tbl_sub_categories(subCategoryName, categoryId, iconimage,subcategoryUrl) 
					VALUES(:subCategoryName, :categoryId, :iconimage, :subcategoryUrl)");
				$stmt->bindparam(":subCategoryName",$subcat_name);
				$stmt->bindparam(":categoryId",$cat_id);
				$stmt->bindparam(":iconimage",$cat_img);
				$stmt->bindparam(":subcategoryUrl",$subcat_url);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}

		public function addSlider($alt_title, $slider_image, $slider_status)
		{
			try
			{

				$stmt = $this->conn->prepare("INSERT INTO tbl_website_slider(sliderImage, altTitle, sliderStatus) 
					VALUES(:sliderImage, :altTitle, :sliderStatus)");
				$stmt->bindparam(":altTitle",$alt_title);
				$stmt->bindparam(":sliderImage",$slider_image);
				$stmt->bindparam(":sliderStatus",$slider_status);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}

		public function dailyReport($emp_name, $emp_dep, $entry_date, $task_mod, $task_status, $task_detail)
		{
			try
			{

				$stmt = $this->conn->prepare("INSERT INTO tbl_daily_report(empName, empDep, entryDate,taskModule,taskStatus,taskDetail) 
					VALUES(:empName, :empDep, :entryDate, :taskModule,:taskStatus,:taskDetail)");
				$stmt->bindparam(":empName",$emp_name);
				$stmt->bindparam(":empDep",$emp_dep);
				$stmt->bindparam(":entryDate",$entry_date);
				$stmt->bindparam(":taskModule",$task_mod);
				$stmt->bindparam(":taskStatus",$task_status);
				$stmt->bindparam(":taskDetail",$task_detail);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}
	public function addbsCategory($bscat_name, $bscat_icon)
		{
			try
			{

				$stmt = $this->conn->prepare("INSERT INTO tbl_bs_categories(bscategoryName, bscategoryIcon) 
					VALUES(:bscategoryName, :bscategoryIcon)");
				$stmt->bindparam(":bscategoryName",$bscat_name);
				$stmt->bindparam(":bscategoryIcon",$bscat_icon);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		} 

		public function addbsSubcategory($bssubcat_name, $bscat_id, $bssubcat_image)
		{
			try
			{

				$stmt = $this->conn->prepare("INSERT INTO tbl_bs_sub_categories(bssubcategoryName, bscategoryId,bssubcategoryImage) 
					VALUES(:bssubcategoryName, :bscategoryId, :bssubcategoryImage)");
				$stmt->bindparam(":bssubcategoryName",$bssubcat_name);
				$stmt->bindparam(":bscategoryId",$bscat_id);
				$stmt->bindparam(":bssubcategoryImage",$bssubcat_image);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}
		public function addAreas($area_name,$area_url, $city_id)
		{
			try
			{

				$stmt = $this->conn->prepare("INSERT INTO tbl_areas(areasName,area_url, cityId) 
					VALUES(:areasName,:area_url, :cityId)");
				$stmt->bindparam(":areasName",$area_name);
				$stmt->bindparam(":area_url",$area_url);
				$stmt->bindparam(":cityId",$city_id);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}
		public function addKeywords($keyword_name, $subcategory_id)
		{
			try
			{

				$stmt = $this->conn->prepare("INSERT INTO tbl_sub_category_keywords(keywords, subCategoryId) 
					VALUES(:keywords, :subCategoryId)");
				$stmt->bindparam(":keywords",$keyword_name);
				$stmt->bindparam(":subCategoryId",$subcategory_id);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}
		public function addFaq($faq_question, $faq_answer,$faq_priority)
		{
			try
			{

				$stmt = $this->conn->prepare("INSERT INTO tbl_faq(faqQuestion, faqAnswer, faqPriority) 
					VALUES(:faqQuestion, :faqAnswer, :faqPriority)");
				$stmt->bindparam(":faqQuestion",$faq_question);
				$stmt->bindparam(":faqAnswer",$faq_answer);
				$stmt->bindparam(":faqPriority",$faq_priority);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}
		
		
			public function metaUpdate($id_type,$id_number, $abstract, $subject, $robots, $alexa,$robots1, $googlebot, $googlebot1,
			$author,$rating, $language, $copyright, $designer, $distribution, $publisher, $applefullscreen,$ogurl, $ogtype, $ad_code, $url, $meta_title, $meta_description, $meta_keywords, $ad_alsolisted)
		{
			try
			{

				$stmt = $this->conn->prepare("INSERT INTO tbl_meta_details(idtype,idnumber, abstract, subject, robots, alexa, robots1, googlebot, googlebot1,
				author,rating, language, copyright, designer, distribution, publisher, applefullscreen,ogurl, ogtype, apCode, apUrl, apMetaTitle, apMetaDescription, apMetaKeywords, apAlsolisted) 
					VALUES(:idtype,:idnumber,:abstract, :subject, :robots, :alexa, :robots1, :googlebot, :googlebot1,
					:author,:rating, :language, :copyright, :designer, :distribution, :publisher, :applefullscreen,:ogurl, :ogtype, :apCode, :apUrl, :apMetaTitle, :apMetaDescription, :apMetaKeywords, :apAlsolisted)");
               
                $stmt->bindparam(":idtype",$id_type);
				$stmt->bindparam(":idnumber",$id_number);
				$stmt->bindparam(":abstract",$abstract);
				$stmt->bindparam(":subject",$subject);
				$stmt->bindparam(":robots",$robots);
				$stmt->bindparam(":alexa",$alexa);
				$stmt->bindparam(":robots1",$robots1);
				$stmt->bindparam(":googlebot",$googlebot);
				$stmt->bindparam(":googlebot1",$googlebot1);
				$stmt->bindparam(":author",$author);
				$stmt->bindparam(":rating",$rating);
				$stmt->bindparam(":language",$language);
				$stmt->bindparam(":copyright",$copyright);
				$stmt->bindparam(":designer",$designer);
				$stmt->bindparam(":distribution",$distribution);
				$stmt->bindparam(":publisher",$publisher);
				$stmt->bindparam(":applefullscreen",$applefullscreen);
				$stmt->bindparam(":ogurl",$ogurl);
				$stmt->bindparam(":ogtype",$ogtype);
				$stmt->bindparam(":apCode",$ad_code);
				$stmt->bindparam(":apUrl",$url);
				$stmt->bindparam(":apMetaTitle",$meta_title);
				$stmt->bindparam(":apMetaDescription",$meta_description);
				$stmt->bindparam(":apMetaKeywords",$meta_keywords);
$stmt->bindparam(":apAlsolisted",$ad_alsolisted);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		} 
		
			public function Addmeta($idtype, $idnumber, $abstract, $subject, $robots, $alexa,$robots1, $googlebot, $googlebot1,
			$author,$rating, $language, $copyright, $designer, $distribution, $publisher, $applefullscreen,$ogtype,$ogtitle,$ogdescription,$ogsitename,$schemascript)
		{
			try
			{
               
				$stmt = $this->conn->prepare("INSERT INTO tbl_meta_details(idtype, idnumber, abstract, subject, robots, alexa, robots1, googlebot, googlebot1,
				author,rating, language, copyright, designer, distribution, publisher, applefullscreen, ogtype, ogtitle, ogdescription, ogsitename, schemascript) 
					VALUES(:idtype, :idnumber,:abstract, :subject, :robots, :alexa, :robots1, :googlebot, :googlebot1,
					:author,:rating, :language, :copyright, :designer, :distribution, :publisher, :applefullscreen,:ogtype, :ogtitle, :ogdescription, :ogsitename, :schemascript)");
               
                $stmt->bindparam(":idtype",$idtype);
				$stmt->bindparam(":idnumber",$idnumber);
				$stmt->bindparam(":abstract",$abstract); 
				$stmt->bindparam(":subject",$subject);
				$stmt->bindparam(":robots",$robots);
				$stmt->bindparam(":alexa",$alexa);
				$stmt->bindparam(":robots1",$robots1);
				$stmt->bindparam(":googlebot",$googlebot);
				$stmt->bindparam(":googlebot1",$googlebot1);
				$stmt->bindparam(":author",$author);
				$stmt->bindparam(":rating",$rating);
				$stmt->bindparam(":language",$language);
				$stmt->bindparam(":copyright",$copyright);
				$stmt->bindparam(":designer",$designer);
				$stmt->bindparam(":distribution",$distribution);
				$stmt->bindparam(":publisher",$publisher);
				$stmt->bindparam(":applefullscreen",$applefullscreen);
				$stmt->bindparam(":ogtype",$ogtype);
				$stmt->bindparam(":ogtitle",$ogtitle);
				$stmt->bindparam(":ogdescription",$ogdescription);
				$stmt->bindparam(":ogsitename",$ogsitename);
				$stmt->bindparam(":schemascript",$schemascript);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		} 
		
		
			public function AddTickets($raisedby, $raisedbyteam, $raisedto, $raisedtoteam, $issues, $issuesdesc, $priority, $acceptstatus, $workstatus, $daysreq, $durationreq)
		{
		    
			try{
			    $ipaddress = '';
    		if (isset($_SERVER['HTTP_CLIENT_IP'])){
        		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    		}
    		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    		}
    		else if(isset($_SERVER['HTTP_X_FORWARDED'])){
        		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    		}
    		else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
        		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    		}
    		else if(isset($_SERVER['HTTP_FORWARDED'])){
        		$ipaddress = $_SERVER['HTTP_FORWARDED'];
    		}
    		else if(isset($_SERVER['REMOTE_ADDR'])){
        		$ipaddress = $_SERVER['REMOTE_ADDR'];
    		}
    		else{
        		$ipaddress = 'UNKNOWN';
    		}
				$stmt = $this->conn->prepare("INSERT INTO tbl_tickets(raised_by, raised_byteam, raised_to, raised_toteam, issues, issues_desc,priority, accept_status, work_status, days_req, duration_required, ip) 
					VALUES('$raisedby','$raisedbyteam','$raisedto', '$raisedtoteam', '$issues', '$issuesdesc','$priority', '$acceptstatus', '$workstatus', '$daysreq', '$durationreq', '$ipaddress')");
				$stmt->execute();
				$stmt->bindparam(":raised_by",$raisedby);
				$stmt->bindparam(":raised_byteam",$raisedbyteam);
				$stmt->bindparam(":raised_to",$raisedto);
				$stmt->bindparam(":raised_toteam",$raisedtoteam);
				$stmt->bindparam(":issues",$issues);
				$stmt->bindparam(":issues_desc",$issuesdesc);
				$stmt->bindparam(":priority",$priority);
                $stmt->bindparam(":accept_status",$acceptstatus);
                $stmt->bindparam(":work_status",$workstatus);
                $stmt->bindparam(":days_req",$daysreq);
                $stmt->bindparam(":duration_required",$durationreq);
                $stmt->bindparam(":ip",$ipaddress);
				return $stmt;
				
			}
			catch(PDOException $ex){
				echo $ex->getMessage();
			}
		}
		
}