function darkmode() {
	document.body.style.backgroundColor="black";
	document.body.style.color="white";
	let thElements = document.querySelectorAll('th');
    let tdElements = document.querySelectorAll('td');
            
        thElements.forEach(th => {
            th.style.borderColor = 'white';
            });
            
        tdElements.forEach(td => {
            td.style.borderColor = 'white';
            });
	localStorage.setItem('backgroundColor', 'black');
	localStorage.setItem('color', 'white');
	localStorage.setItem('thBorderColor', 'white');
	localStorage.setItem('tdBorderColor', 'white');
	}
	

	
function lightmode() {
	document.body.style.backgroundColor="white";
	document.body.style.color="black";
	let thElements = document.querySelectorAll('th');
    let tdElements = document.querySelectorAll('td');
            
        thElements.forEach(th => {
            th.style.borderColor = 'black';
            });
            
        tdElements.forEach(td => {
            td.style.borderColor = 'black';
            });
	localStorage.setItem('backgroundColor', 'white');
	localStorage.setItem('color', 'black');
	localStorage.setItem('thBorderColor', 'black');
	localStorage.setItem('tdBorderColor', 'black');
	}
	
window.onload=function() {
	if(localStorage.getItem('backgroundColor')) {
		document.body.style.backgroundColor=localStorage.getItem('backgroundColor');
		document.body.style.color=localStorage.getItem('color');	
	}
	let thBorderColor=localStorage.getItem('thBorderColor');
	let tdBorderColor=localStorage.getItem('tdBorderColor');
	if(thBorderColor && tdBorderColor) {
		let thElements=document.querySelectorAll('th');
		let tdElements=document.querySelectorAll('td');
		thElements.forEach(th => {
			th.style.borderColor=thBorderColor;
		});
		tdElements.forEach(td => {
			td.style.borderColor=tdBorderColor;
		});
	}
}
document.getElementById("notice").innerHTML = "알림 : 25년9월26일자 변경 데이터가 반영되었습니다.";