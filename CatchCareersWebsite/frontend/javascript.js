//change nav bar color
$(document).ready(function(){
    $(window).scroll(function(){
        var scroll=$(window).scrollTop();
        if (scroll>50){
            $(".navbar").css("background","#222");
            $(".navbar").css("box-shadow","rgba(0,0,0,0.1) 0px 4px 12px");
        }
        else{
            $(".navbar").css("background","transparent");
            $(".navbar").css("box-shadow","none");
        }
    })
})

function openForm(){
    document.getElementById("loginBox").style.display="block";
}
function closeForm(){
    document.getElementById("loginBox").style.display="none";
}

function myFunction(){
    document.getElementById("dropdown").classList.toggle("show");
}
window.onclick= function(event){
    if(!event.target.matches('.buttonSignUp')){
        var dropdowns=document.getElementsByClassName("dropdown");    
        var i;
        for(i=0; i<dropdowns.length;i++){
            var openDropdown=dropdowns[i];
            if(openDropdown.classList.contains('show')){
                openDropdown.classList.remove('show');
            }
        }
    }
    
}

//Register as Company Admin
function openFormCA(){
    document.getElementById("registerBoxCA").style.display="block";
}
function closeFormRgstr(){
    document.getElementById("registerBoxCA").style.display="none";
}

//Register as User
function openFormUser(){
    document.getElementById("registerBoxUser").style.display="block";
}
function closeFormRgstrUser(){
    document.getElementById("registerBoxUser").style.display="none";
}



//moreButton
function moreFunction(){
    var moreDots=document.getElementById("dots");
    var moreItem=document.getElementById("more");
    var moreButton=document.getElementById("btnmore");

    if(dots.style.display==="none"){
        dots.style.display="inline";
        moreButton.innerHTML="View More";
        moreItem.style.display="none";
    } else{
        dots.style.display="none";
        moreButton.innerHTML="View Less";
        moreItem.style.display="inline";
    }


    document.getElementById("btnmore").addEventListener("click", function() {
        var items = document.getElementsByClassName("item");
        for (var i = 0; i < items.length; i++) {
          items[i].style.display = "block"; // Display all items
        }
        this.style.display = "none"; // Hide the "View More" button
      });
      


}




//Company_Admin Dashboard Openning and dissapear
function OpenmainPersonalInfo(){
    document.getElementById("mainPersonalInfo").style.display="block";
}
function btnPInfo(){
    document.getElementById("mainPersonalInfo").style.display="none";
}

function showDiv(divId) {
    // Get all content divs
    var contentDivs = document.getElementsByClassName("content");
    
    // Hide all content divs
    for (var i = 0; i < contentDivs.length; i++) {
        contentDivs[i].style.display = "none";
    }
    
    // Show the selected div
    var selectedDiv = document.getElementById(divId);
    selectedDiv.style.display = "block";
}

//logout from user Dashboard.
 // JavaScript code for logout button and confirmation pop-up
 window.addEventListener('DOMContentLoaded', () => {
    const logoutButton = document.getElementById('logoutButton');

    // Event listener for logout button click
    logoutButton.addEventListener('click', () => {
      // Display the confirmation pop-up
      const confirmLogout = confirm('Are you sure you want to logout?');

      // Redirect to logout page or perform logout action
      if (confirmLogout) {
        // Replace the URL below with the actual logout page or action
       window.location.href = 'logout.php';
      }
    });
  });

//search bar code.
// Get the search input element and search button element
const searchInput = document.querySelector('.Search-input');
const searchButton = document.querySelector('.search-button');

// Add event listener to the search button
searchButton.addEventListener('click', performSearch);

// Add event listener to the search input for pressing Enter
searchInput.addEventListener('keydown', function (event) {
  if (event.key === 'Enter') {
    performSearch();
  }
});


        
// Apply Job Button
const applyButton = document.getElementById('apply-button');
applyButton.addEventListener('click', () => {
// Check if user is logged in (example code)
if (isLoggedIn()) {
// Display success message
alert('Job applied successfully!');

// Get job ID and user ID (example code)
const jobId = document.getElementById('jobID').value;
const userId = getUserId(); // Example function to retrieve the user ID

// Send AJAX request to server-side PHP code
const xhr = new XMLHttpRequest();
xhr.open('POST', '/applyJob.php');
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xhr.onload = function() {
if (xhr.status === 200) {
console.log('Application saved to database');
}
};
xhr.send(`jobId=${jobId}&userId=${userId}`);
} else {
// Redirect to login page or display login prompt
alert('Please log in to apply for the job.');
}
});
