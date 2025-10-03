
<style>
.modal-dialog {
  top: 50px !important;
}
.btn_pink{
	background-color:#F33;
	}
.btn_yellow{
	background-color:#FC0}

.vote-nav {
  position: fixed;
  -webkit-transition: 0.3s;
  -o-transition: 0.3s;
  transition: 0.3s;
  right: 0;
  top: 250px;
  padding: 0;
  list-style: none;
  display: inline-block;
  margin: 10px auto; }
  .vote-nav li {
    float: none;
    display: block; }
  .vote-nav button {
    border-radius: 10;
	margin-bottom:2px;
    display: inline-block;
    float: right;
    width: 58px;
    height: 58px;
    font-size: 20px;
    color: #fff;
    text-decoration: none;
    cursor: pointer;
    text-align: center;
    line-height: 48px;
    position: relative;
    -webkit-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s;
    outline: none;
    border: 0;
    -webkit-box-shadow: none !important;
            box-shadow: none !important; }
    @media (max-width: 991.98px) {
      .vote-nav button {
        width: 48px;
        height: 48px;
        line-height: 30px; } }
    .vote-nav button:hover {
      padding-right: 20px;
      width: 85px;
      border-radius: 2px; }
      @media (max-width: 991.98px) {
        .vote-nav button:hover {
          width: 75px;
          padding-right: 10px; } }
    @media (max-width: 991.98px) {
      .vote-nav button.btn-tall {
        height: 58px; } }
		

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 70%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 18px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}	
p{
	color:#333;}	
		
</style>
<script>
var glb_vote;
var glb_blogId = 123; // map blog id here


function callButton(pr){
	
	 modal.style.display = "block";
	if(pr=='tel'){
		$('#tedDiv').show();
		$('#mapDiv').hide();
		
		}else{
			$('#tedDiv').hide();
		    $('#mapDiv').show();
			}
	}

function onVoteOptionClick(elem, vote) {
    glb_vote = vote;
    var jElem = $(elem);
    jElem.parent().parent().find('li.vote-button').addClass('d-none');
    jElem.parent().parent().find('li.vote-confirm').removeClass('d-none');
}

function cancelVoteConfirm(elem) {
    glb_vote = null;
    var jElem = $(elem);
    jElem.parent().parent().find('li.vote-button').removeClass('d-none');
    jElem.parent().parent().find('li.vote-confirm').addClass('d-none');
}

 function confirmVote(elem) {
    var jElem = $(elem);
    var vote = glb_vote;
    var competition = "blog"
    var blogId = glb_blogId;

    if (competition && vote && blogId) {
   //     await firebase_savevote(competition, vote, blogId);
    }

    jElem.parent().parent().find('li.vote-button').addClass('d-none');
    jElem.parent().parent().find('li.vote-confirm').addClass('d-none');
    var myVote = jElem.parent().parent().find('li.myvote').removeClass('d-none');
    myVote.find('span.'+ vote).removeClass('d-none');

    jElem.parent().parent().find('li.vote-title .vote-banner').addClass('d-none');
    jElem.parent().parent().find('li.vote-title .myvote-banner').removeClass('d-none');

    glb_blogId = null;
//    await loadVoteInfo();
}
</script>
<ul class="vote-nav">
			<li class="vote-title text-right pr-2 font-weight-bold">
				<span class="vote-banner" style="color:#F00">
				<b>Contact 
				</br>
				Us</b>
				</span>
			<!--<span class="myvote-banner d-none">
				My Vote
				</span>-->
		</li>
		<li class="vote-button">
			<button type="button" class="btn btn-primary" onclick="callButton('tel');" id="myBtn">
					<i class="fa fa-phone-square" aria-hidden="true"></i>
			</button>
		</li>
		<li class="vote-button">
			<button type="button" class="btn btn-danger" onclick="callButton('tel')" id="myBtn">
					<i class="fa fa-envelope" aria-hidden="true"></i>
			</button>
		</li>
		<li class="vote-button">
			<button type="button" class="btn btn-warning" onclick="callButton('map')">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
			</button>
		</li>
        <li class="vote-button">
			<button type="button" class="btn btn-success" onclick="window.open('http://www.phsrc.lk/index.php')">
					<i class="fa fa-globe" aria-hidden="true"></i>
			</button>
		</li>
       
		<li class="vote-confirm d-none">
			<button type="button" class="btn btn-primary" onclick="confirmVote(this)">
				<span class="icon-check"></span>
			</button>
		</li>
		<li class="vote-confirm d-none">
			<button type="button" class="btn btn-danger" onclick="cancelVoteConfirm(this)">
				<span class="icon-close"></span>
			</button>
		</li>
		<li class="myvote d-none">
			<button type="button" class="btn btn-primary">
				<span class="1 d-none">1<sup>st</sup>
				</span>
				<span class="2 d-none">2<sup>nd</sup>
				</span>
				<span class="3 d-none">3<sup>rd</sup>
				</span>
			</button>
		</li>
	</ul>
    <!----------------------------------------------------------------------------------------------------->
    
    <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="col-md-12"><img src="img/core/Capture1.JPG" style="width:100%"/></div><br>
   <center>
    <div id="tedDiv">
    <br/>
    <br/>
    <p><span style="color:#F00"><i class="fa fa-address-card" aria-hidden="true"></i></span>
 No 2A, CBM House, 4th Floor, Lake Drive, Colombo 08, Sri Lanka.</p>
     <p> <span style="color:#060"><i class="fa fa-phone-square" aria-hidden="true"></i>
</span>Tel : +94112672911, +94112672912</p>
     <p> <span style="color:#F90"><i class="fa fa-fax" aria-hidden="true"></i>
</span> Fax : +94112672913</p>
<br />
<br/>
<p> <span style="color:#09C"><i class="fa fa-envelope" aria-hidden="true"></i>

</span> Mail : phsrc@sltnet.lk</p>
    </div>
    <div id="mapDiv">
      <p><span style="color:#F00"><i class="fa fa-address-card" aria-hidden="true"></i></span>
 No 2A, CBM House, 4th Floor, Lake Drive, Colombo 08, Sri Lanka.</p>
    <iframe src="https://maps.google.com/maps?width=100%&amp;height=200&amp;hl=en&amp;coord=6.909604099999999,79.88817569999992&amp;q=No.%202A%2C%20CBM%20House%2C%204th%20Floor%2C%20Lake%20Drive%2C%20Colombo%2008+(Private%20Health%20Services%20Regulatory%20Council)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" scrolling="no" marginheight="0" marginwidth="0" width="100%" height="280" frameborder="0"></iframe>
    </div>
   </center>
  </div>

</div>
    
    
  <script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
/*btn.onclick = function() {
  modal.style.display = "block";
}*/

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
  
    
    
    
    <!----------------------------------------------------------------------------------------------------->
	