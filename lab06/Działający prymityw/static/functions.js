// JavaScript Document

	function validate(){
		var check=true;
		
		if (document.form1.pole1.value=="" ){
		document.getElementById("empty_name").innerHTML = "Brak imienia";
		check = false;
		}
		else document.getElementById("empty_name").innerHTML = "";
		if (document.form1.pole2.value=="" ){
		document.getElementById("empty_surname").innerHTML = "Brak nazwiska";
		check = false;
		}
		else document.getElementById("empty_surname").innerHTML = "";
		if (document.form1.pole3.value=="" ){
		document.getElementById("empty_mail").innerHTML = "Brak adresu e-mail";
		check = false;
		}
		else document.getElementById("empty_mail").innerHTML = "";
		
		var lista = document.getElementById("lista");
		var selectedValue = lista.options[lista.selectedIndex].value;
		if (selectedValue=="none" ){
		document.getElementById("empty_year").innerHTML = "Brak wybranego roku";
		check = false;
		}
		else document.getElementById("empty_year").innerHTML = "";
		
		if(check){
		return true;
		}
		return false;
	}

    function openTab(evt, TabName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(TabName).style.display = "block";
            evt.currentTarget.className += " active";
    }

    var redirect = function(){
        document.location.href="lab6.html"
     }