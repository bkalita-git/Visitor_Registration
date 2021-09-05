<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="webcam-easy.min.js"></script>
        <title>form</title>
    <style>
        *{ box-sizing: border-box; }
        #m-form{
            position: relative;
            //border:1px solid green;
            display: flex;
            width:100%;
            flex-wrap: wrap;
            justify-content: space-between;
            padding:10px;
        }
        .form-input-wrapper{
            //border: #adff2f 1px solid;
            flex:1 1 250px;  
            margin:10px;
        }
        .form-input-label{
            //border: hotpink 1px  solid;
            display: block;

        }
        .l-width-50p{
            width:50%;
        }
        .form-input-area{
            width: 100%;
        }
        .break {
            flex-basis: 100%;
            height: 0;
        }
        .make-it-flex{
            display: flex;
            justify-content: space-between;
           
        }
        .make-it-flex>div{
            align-self: center;
            
        }
        .radio-container{
            display:inline-block;
            position: relative;
            padding-left: 30px;
            font-size: 20px;
        }
        .radio-box{
            position: absolute;
            left:0;
            top:0;
            width:25px;
            height:25px;
            background-color: rgb(158, 156, 157);
            border-radius: 50%;
        }
       .radio-container>input{
           position: absolute;
           left:0;
           opacity: 0;
       }
       .radio-container input:checked ~ .radio-box{
           background-image: radial-gradient(#93b110 2%,#160101 100%);
/*            background-image: radial-gradient(#160101 2%,#2dff2d 50%);
 */           box-shadow: 0px 0px 4px 1px #275df0 ;
       }
       
	.grid-container {
        justify-content:center;
        display:flex;
  		display: grid;
  		//grid-column-gap:  ;
		//grid-row-gap:   ;
		//grid-gap:   ;
		grid-template-columns: auto auto;  
		//contain 2 columns, specify the width of the 2 columns, or "auto" if all columns should have the same width.
		grid-template-rows: rf; //1 row
		justify-content: center;
		align-content: center;
		grid-template-areas: 'form snap';
	}

	.item-1 {
        color:white;
        align-items:center;
        border-top-left-radius: 25px;
        border-bottom-left-radius: 25px;
		grid-area: form;
	}
	.item-2{
        border-top-right-radius: 25px;
        border-bottom-right-radius: 25px;
		grid-area: snap;
		text-align:center;
       
	
	}
	#canvas{
		display:none;
		border:2px solid blue;
	}
	#profile-pic{
		border:2px solid blue;
		//width: 100px;
		//height:100px;
	}
	#webcam{
		opacity: 0.5;
	}

    #it-header{
        align-items:center;
        color:#ff8000;
        text-align:center;
        height:100px;
        width:100%;
        font-weight:bold;
        font-size:30px;
        display:flex; 
        justify-content:center; 
        flex-direction:row;
    }
    #it-footer{
        background-color:#008000;
        color:white;
        text-align:center;
        align-items:center;
        height:100px;
        width:100%;
        border-radius:25px;
        font-weight:bold;
        font-size:20px;
        display:flex; 
        justify-content:center; 
        flex-direction:row;
        box-shadow: 0px 0px 10px 5px #ff8000;
    }
    #logo{
        width:100px;
    }
    </style>
</head>
<body>
    <div id="it-header">VISITOR REGISTRATION SYSTEM</div>
    <div class="grid-container" >
    	<div class="item-1" style="background-color:#008000; ">
		    <form autocomplete="on" id='m-form' name="m-form" enctype="multipart/form-data">
			<div class="form-input-wrapper ">
			    <label class="form-input-label" for="Name">Name</label>
			    <input  style="text-transform: capitalize;" class="form-input-area" type="text" name="Name" required>
			</div>
			<div class="break"></div>
			<div class="form-input-wrapper flex-full-width ">
			    <label class="form-input-label" for="Addr">Address</label>
			    <input style="text-transform: capitalize;" class="form-input-area" type="text" name="Addr" required>
			</div>
			<div class="break"></div>
			    <div class="form-input-wrapper flex-full-width ">
			    <label class="form-input-label" for="mobileNumber">Mobile Number</label>
			    <input style="text-transform: capitalize;" class="form-input-area" type="number" minlength="10" maxlength="10"  pattern="[0-9]{10}" name="Ph" required>
			</div>
			<div class="break"></div>
			    <div class="form-input-wrapper flex-full-width ">
			    <label class="form-input-label" for="whomToMeet">Whom To Meet</label>
                <div style="display:flex;">
                    <input style="text-transform: capitalize;" list="browsers" class="form-input-area" type="text" name="whomToMeet" required>
                    <button id='button' onclick="add_to_whm(this.previousElementSibling.value())">Add</button>
                </div>
                <?php include "./datalist.html" ?>
			</div>
		    </form>
            <div id="whm_list">
            </div>
	    </div>
	    <div class="item-2" style="width: 420px; background-color:#ff8000">
		    <div style="position:relative; " class="form-input-wrapper flex-full-width ">
		    	<video id="webcam" autoplay playsinline width="200"></video>
                <canvas id="" style="border:2px solid red; position:absolute; bottom:2px; left:138px;" width="120" height="120" class="d-none"></canvas>
		    </div>
		    <div class="form-input-wrapper flex-full-width ">
			    <canvas id="canvas" width="200" class="d-none"></canvas>
		    </div>
    		<div class="form-input-wrapper flex-full-width ">
			    <canvas id="profile-pic" width="120" height="120" class="d-none"></canvas>
		    </div>
		    <div style=" display: flex; gap:12px; justify-content: center;  flex-direction: row;" class="form-input-wrapper flex-full-width ">
                <!--button onclick="snap()" class="btn"><i class="fas fa-camera"></i> Capture</button-->
                <img onclick="snap()" style=" width:60px;" src="camera.png"/>
			    <button style="border-radius:10px; color:white; background-color:red; font-weight:bold;" onclick="upload()">UPLOAD</button>
                <img onclick="form_clear()" style=" width:40px;" src="delete.png"/>
		    </div>
	    </div>
    </div>
    <br/>
    <div id="it-footer">
        <img id="logo" src="logo.png"/>
        <div>DEVELOPED by IT Cell, BJP ASSAM PRADESH</div>
        <img id="logo" src="logo.png"/>
    </div>
    
 
    <script>
        var pic_flag = 0;
        var file;
        var oData;
        const webcamElement = document.getElementById('webcam');
        const canvasElement = document.getElementById('canvas');
        const webcam = new Webcam(webcamElement, 'user', canvasElement);

        webcam.start()
        .then(result =>{
            console.log("webcam started");
        })
        .catch(err => {
            console.log(err);
        });
        
        
        function snap(){
            let picture = webcam.snap();
            var profilePic = document.getElementById("profile-pic"); 
            var contex = profilePic.getContext("2d"); 
            contex.drawImage(canvasElement, 40, 30, 120, 120, 0, 0, 120, 120); 
            //var png = ReImg.fromCanvas(profilePic).toPng();
            //alert(png);
            var png = profilePic.toDataURL();
            file = dataURLtoFile(png,'hello.png');
            pic_flag = 1;
        }
        
        
        function dataURLtoFile(dataurl, filename) {
        var arr = dataurl.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), 
            n = bstr.length, 
            u8arr = new Uint8Array(n);
            
        while(n--){
            u8arr[n] = bstr.charCodeAt(n);
        }
        
        return new File([u8arr], filename, {type:mime});
        }
        
        function validateForm() {
            var a = document.forms["m-form"]["Name"].value;
            var b = document.forms["m-form"]["Addr"].value;
            var c = document.forms["m-form"]["Ph"].value;
            var d = document.forms["m-form"]["whomToMeet"].value;
            if (a == null || a == "" || b == null || b == ""|| d == null || d == "" ) {
                alert("Please Fill All Required Field");
                return false;
            }
            if(c.length!=10){
                alert("Invalid Mobile Number");
                return false;
            }
            if(pic_flag==0){
                alert("Please Capture the Face");
                return false;
            }
            return true;
        }
                
        function form_clear(){
            var form = document.getElementById("m-form");
            form.reset(); 
            var profilePic = document.getElementById("profile-pic"); 
            var contex = profilePic.getContext("2d"); 
            contex.beginPath();
            contex.rect(0,0,120,120);
            contex.fillStyle  = "white";
            pic_flag = 0;
            contex.fill();
        }

        function upload(){
            var form = document.getElementById("m-form");
            oData = new FormData(form);
            oData.append("img_file",file);
            oData.target = '_blank';
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //var myObj = JSON.parse(this.responseText);
                var newWindow = window.open("", "new window", "");
                newWindow.document.write(this.responseText);
                newWindow.print();
                newWindow.close();
                form_clear();
                //contex.drawImage(canvasElement, 40, 30, 120, 120, 0, 0, 120, 120); 
                
                
            }
            };
            xmlhttp.open("POST", "/visitor/upload/", true);
            if(validateForm()) {
                xmlhttp.send(oData);
            }
        }

        function add_to_whm(text){
            var li = document.getElementById("whm_list");
            var textnode = document.createTextNode(text);
            li.appendChild(textnode);

        }
    </script>
</body>
</html>
