// Mobile Responsive
function toggleMenu() {
          const navLinks = document.querySelector('.nav-links');   
          navLinks.classList.toggle('active');
      }
           
//Contact Us
function contactJs()
        {
        let name1=document.getElementById("name").value;
        let email1=document.getElementById("email").value;
        let subject1=document.getElementById("subject").value;
        let massage1=document.getElementById("message").value;

        let isValid = true;

            if(name1==null||name1=="")
                {
                    alert("Enter the name");
                    isValid = false;
                }
            if(email1==null||email1=="")
                {
                    alert("Enter the email");
                    isValid = false;
                }
            if(subject1==null||subject1=="")
                {
                    alert("Enter the Subject");
                    isValid = false;
                }
            if(massage1==null||massage1=="")
                {
                    alert("Enter the Massage");
                    isValid = false;
                }
            if (isValid)
            {
                 alert("Your Message sent successfully!!");
            }
            
        }

//FAQ        
document.querySelectorAll('.faq-item').forEach(item => {
            item.querySelector('.question').addEventListener('click', () => {
                const answer = item.querySelector('.answer');
                const toggle = item.querySelector('.toggle');
        
                if (answer.style.display === 'block') {
                    answer.style.display = 'none';
                    toggle.textContent = '+';
                } else {
                    answer.style.display = 'block';
                    toggle.textContent = '-';
                }
            });
        });

//Home Page SlideShow        
let slideIndex = 1; 
 function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            if (n > slides.length) {slideIndex = 1}    
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slides[slideIndex-1].style.display = "block";  
        }

        function changeSlide(n) {
            showSlides(slideIndex += n);
        }

        setInterval(() => {
            showSlides(slideIndex += 1);
        }, 2000);       
        



