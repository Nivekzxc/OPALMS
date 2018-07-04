function handler(e){
                            var dateto = (e.target.value);
                            var datefrom = document.getElementById('leavefrom').value;
                            var date1 = new Date(datefrom);
							var date2 = new Date(dateto);
							var timeDiff = Math.abs(date2.getTime() - date1.getTime());
							var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                            document.getElementById('DaysOfLeave').value = diffDays;
                            
}
function LeaveCredits(){
							var Selectdatefrom = document.getElementById('dateHire').value;
							var Selectdateto = document.getElementById('dateNoww').value;
							var deduck = document.getElementById('deduck').value;
							var sdate1 = new Date(Selectdatefrom);
							var sdate2 = new Date(Selectdateto);
							var stimeDiff = Math.abs(sdate2.getTime() - sdate1.getTime());
							var sdiffDays = Math.ceil(stimeDiff / (1000 * 3600 * 24));
							var sdifDay = sdiffDays - deduck;
	                        document.getElementById('Remaining').value = sdifDay;
                            
}
function displayAvailable(e){
								Selected = (e.target.value);
								var Credits = document.getElementById('Remaining').value;
								var Gender = document.getElementById('iGender').value;
								var Status = document.getElementById('iStatus').value;
								var Deduct = document.getElementById('DaysOfLeave').value;
							if (Selected == 'Forced/Mandatory Leave') {
								var available = Credits / 24;
								var deduction = 24;
							}
							if (Selected == 'Rehabilitation Leave'){
								var available = Credits / 12;
								var deduction = 12;
							}
							if (Selected == 'Sick Leave'){
								var available = Credits / 24;
								var deduction = 24;
							}
							if (Selected == 'Special Emergency Leave'){
								var available = 5;
								var deduction = 24;
							}
							if (Selected == 'Study Leave'){
								var available = Credits / 18.25;
								var deduction = 18.25;
							}
							if (Selected == 'Vacation Leave'){
								var available = Credits / 24;
								var deduction = 24;
							}
							if (Selected == 'Paternity Leave' && Gender == 'Male' && Status == 'Married'){
								var available = Credits / 52.14;
								var deduction = 52.14;
							}
							if (Selected == 'Maternity Leave' && Gender == 'Female'){
							 	var available = Credits / 12.16;
								var deduction = 12.16;
							}
							else{
							document.getElementById('AvailableLeaves').value = '';	
							}
							document.getElementById('AvailableLeaves').value = available;
							var bawas = Deduct * deduction;
							document.getElementById('Deductionn').value = bawas;
}