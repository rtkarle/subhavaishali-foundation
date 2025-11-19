
function openForm(){
  document.getElementById("donationFormBox").style.display="flex";
}
function closeForm(){
  document.getElementById("donationFormBox").style.display="none";
}

function startPayment(){
  let name=document.getElementById("name").value;
  let email=document.getElementById("email").value;
  let amount=document.getElementById("amount").value;

  if(!name || !email || !amount){
     alert("Please fill all fields");
     return;
  }

  var options={
    "key":"rzp_test_RhX35z3NVonnlG",
    "amount":amount * 100,
    "currency":"INR",
    "name":"Subhvaishali Foundation",
    "description":"Donation",
    "handler": function (response){
        alert("Thank you! Payment Successful.");
    },
    "prefill": {
        "name": name,
        "email": email
    }
  };

  var rzp=new Razorpay(options);
  rzp.open();
}

