<?php
// donate.php – Donation Page
$prefillAmount = '';
if (isset($_GET['amount']) && is_numeric($_GET['amount']) && $_GET['amount'] > 0) {
    $prefillAmount = htmlspecialchars($_GET['amount']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Donate – Subhvaishali Foundation</title>

<!-- Main site CSS (header, footer etc.) -->
<link rel="stylesheet" href="style.css">

<style>
/* PAGE BACKGROUND */
body{
  font-family: "Inter", sans-serif;
  background: radial-gradient(circle at top, #ffe1c8 0, #ffd4b2 35%, #fef5ef 100%);
  color:#1a1a1a;
  margin:0;
}
/* ----------------------------------------------------
   MOBILE MENU BUTTON
---------------------------------------------------- */
.menu-icon {
  display: none;
  font-size: 32px;
  color: #ff6a00;
  cursor: pointer;
  font-weight: 900;
}

/* ----------------------------------------------------
   MOBILE NAVIGATION
---------------------------------------------------- */
@media(max-width: 850px) {

  .menu-icon {
    display: block;
  }

  .nav {
    position: fixed;
    top: 80px;
    right: -260px;
    width: 240px;
    height: 100vh;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    display: flex;
    flex-direction: column;
    padding: 25px;
    gap: 18px;
    box-shadow: -4px 0 18px rgba(0,0,0,0.12);
    border-left: 3px solid #ff6a00;
    transition: 0.35s ease;
    z-index: 999999;
  }

  /* When menu is opened */
  .nav.show {
    right: 0;
  }

  /* Mobile nav links */
  .nav a {
    margin: 0;
    padding: 10px 0;
    text-align: left;
    color: #ff6a00;
    font-size: 18px;
    font-weight: 700;
  }

  .btn-nav {
    margin-top: 12px;
    text-align: center;
  }

  /* Hide desktop nav */
  .nav-container nav {
    display: none;
  }

  /* Show our custom nav */
  #mobileMenu {
    display: flex;
  }
}


/* WRAPPER */
.donate-wrapper{
  max-width:1100px;
  margin:110px auto 70px;
  padding:20px;
}

/* MAIN CARD */
.donate-card{
  background:rgba(255,255,255,0.92);
  border-radius:26px;
  box-shadow:0 18px 40px rgba(255,120,40,0.22);
  padding:26px 26px 30px;
  display:grid;
  grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr);
  gap:30px;
  border:1px solid rgba(255,153,84,0.35);
  position:relative;
  overflow:hidden;
}

/* Orange soft glow */
.donate-card::before{
  content:"";
  position:absolute;
  right:-120px;
  top:-120px;
  width:280px;
  height:280px;
  background:radial-gradient(circle, rgba(255,140,60,0.22), transparent 70%);
  filter:blur(10px);
  z-index:0;
}

/* Left / Right sections content above glow */
.donate-card > div{
  position:relative;
  z-index:2;
}

/* PAGE TAG */
.tag-badge{
  display:inline-flex;
  align-items:center;
  gap:6px;
  background:#ff7a1a;
  color:#fff;
  border-radius:999px;
  padding:4px 10px;
  font-size:12px;
  font-weight:600;
  margin-bottom:12px;
}
.tag-badge span.dot{
  width:8px;height:8px;border-radius:999px;background:#fed7aa;
}

/* HEADINGS */
.donate-title{
  font-size:30px;
  font-weight:800;
  margin-bottom:6px;
  background: linear-gradient(90deg,#ff6a00,#ff914d);
  -webkit-background-clip:text;
  color:transparent;
}
.donate-sub{
  font-size:14px;
  color:#4b5563;
  margin-bottom:18px;
}

/* STEPS TEXT */
.donate-steps{
  font-size:13px;
  color:#6b7280;
  margin-bottom:14px;
}
.donate-steps span{
  font-weight:700;
  color:#ff6a00;
}

/* FORM GRID */
.form-grid{
  display:grid;
  grid-template-columns: repeat(2,minmax(0,1fr));
  gap:12px 16px;
}
.form-grid-full{
  grid-column:1 / -1;
}

/* LABEL & INPUTS */
.field-label{
  font-size:13px;
  font-weight:600;
  margin-bottom:4px;
  color:#374151;
}
.field-input, .field-select, .field-textarea{
  width:100%;
  padding:9px 11px;
  border-radius:10px;
  border:1px solid #e5e7eb;
  outline:none;
  font-size:13px;
  transition: all .18s ease;
  background:#f9fafb;
}
.field-input:focus,
.field-select:focus,
.field-textarea:focus{
  border-color:#ff6a00;
  box-shadow:0 0 0 1px rgba(255,106,0,0.18);
  background:#fff;
}
.field-textarea{
  min-height:70px;
  resize:vertical;
}
.helper-text{
  font-size:11px;
  color:#6b7280;
  margin-top:4px;
}

/* PAYMENT METHOD CHIPS */
.radio-row{
  display:flex;
  gap:12px;
  flex-wrap:wrap;
  margin-top:4px;
}
.radio-chip{
  display:inline-flex;
  align-items:center;
  gap:6px;
  padding:6px 12px;
  border-radius:999px;
  border:1px solid #e5e7eb;
  font-size:12px;
  cursor:pointer;
  background:#fff;
  transition:0.2s;
}
.radio-chip input{
  accent-color:#ff6a00;
}
.radio-chip.active{
  border-color:#ff6a00;
  background:rgba(255,106,0,0.04);
}

/* UPLOAD BOX */
.upload-box{
  border:1px dashed #ffb98a;
  border-radius:12px;
  padding:10px 11px;
  background:#fff7ed;
  font-size:12px;
}
.upload-box input{
  font-size:11px;
}

/* BUTTONS ROW */
.btn-row{
  margin-top:16px;
  display:flex;
  gap:10px;
  flex-wrap:wrap;
}
.btn-primary{
  border:none;
  outline:none;
  padding:10px 20px;
  border-radius:999px;
  font-size:13px;
  font-weight:650;
  cursor:pointer;
  background:linear-gradient(135deg,#ff7a1a,#ff6a00);
  color:#fff;
  box-shadow:0 10px 24px rgba(255,106,0,0.35);
  display:inline-flex;
  align-items:center;
  gap:6px;
  transition:0.25s;
}
.btn-primary:hover{
  transform:translateY(-2px);
  box-shadow:0 14px 28px rgba(255,106,0,0.45);
}
.btn-secondary{
  border:none;
  outline:none;
  padding:9px 16px;
  border-radius:999px;
  font-size:12px;
  font-weight:500;
  cursor:pointer;
  background:#ffffff;
  color:#374151;
  border:1px solid #e5e7eb;
  display:inline-flex;
  align-items:center;
  gap:6px;
  transition:0.25s;
}
.btn-secondary span.icon{
  font-size:15px;
}
.btn-secondary:hover{
  background:#fff7ed;
  border-color:#ffb98a;
}

/* RIGHT SIDE – PAYMENT INFO */
.sec-right{
  border-left:1px solid rgba(148,163,184,0.25);
  padding-left:22px;
}
@media(max-width:900px){
  .sec-right{
    border-left:none;
    border-top:1px solid rgba(148,163,184,0.3);
    padding-left:0;
    padding-top:18px;
  }
}

.sec-right h3{
  font-size:17px;
  font-weight:700;
  margin-bottom:4px;
  color:#111827;
}
.sec-right p{
  font-size:13px;
  color:#4b5563;
  margin-bottom:6px;
}

.small-pill{
  display:inline-block;
  padding:3px 9px;
  border-radius:999px;
  background:#fff7ed;
  color:#c2410c;
  font-size:11px;
  font-weight:600;
  margin-bottom:6px;
}

/* UPI / NETBANKING BOXES */
.payment-box{
  margin-top:10px;
  padding:10px 12px;
  border-radius:12px;
  background:#fffaf5;
  border:1px solid rgba(251,146,60,0.35);
  font-size:12px;
}
.payment-title{
  font-size:13px;
  font-weight:700;
  color:#b45309;
  margin-bottom:4px;
}

/* QR + UPI */
.upi-flex{
  display:flex;
  align-items:center;
  gap:12px;
  margin-top:6px;
}
.qr-wrap {
  width: 200px;
  height: 200px;
  border-radius: 16px;
  background: #fff;
  border: 1px solid #fee2c3;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  box-shadow: 0 10px 28px rgba(255,150,90,0.25);
}

.qr-wrap img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

.qr-wrap img{
  max-width:100%;
  max-height:100%;
  object-fit:contain;
}
.upi-id{
  display:inline-block;
  font-family:monospace;
  font-size:13px;
  padding:4px 9px;
  background:#fef3c7;
  border-radius:999px;
  margin-top:3px;
}

/* BANK DETAILS */
.bank-list{
  list-style:none;
  padding-left:0;
  margin-top:6px;
}
.bank-list li{
  margin-bottom:4px;
  font-size:12px;
  color:#374151;
}

/* IMPACT HIGHLIGHT */
.highlight-amount{
  font-size:18px;
  font-weight:800;
  color:#16a34a;
  margin-top:10px;
}
.benefits-list{
  margin-top:6px;
  font-size:12px;
  color:#4b5563;
  padding-left:18px;
}
.benefits-list li{
  margin-bottom:4px;
}

/* TRUST BAR */
.trust-strip{
  margin-top:14px;
  padding-top:10px;
  border-top:1px dashed rgba(148,163,184,0.45);
  display:flex;
  flex-wrap:wrap;
  gap:10px 25px;
  font-size:11px;
  color:#6b7280;
}
.trust-strip span{
  display:flex;
  align-items:center;
  gap:6px;
}
.trust-icon{
  font-size:13px;
}

/* RESPONSIVE */
@media(max-width:900px){
  .donate-card{
    grid-template-columns:1fr;
    margin-top:8px;
  }
  .donate-wrapper{
    margin-top:95px;
    padding:16px;
  }
}
</style>
</head>
<body>

<!-- HEADER (from style.css – keep same HTML structure as your site) -->
<header class="header">
  <div class="nav-container">

      <a href="index.html" class="logo-box">
          <img src="logo.jpg" class="logo-img" alt="Logo">
          <div class="logo-text">Subhvaishali</div>
      </a>

      <nav class="nav" id="mobileMenu">
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="activities.html">Our Stories</a>
        <a href="impact.html">Impact</a>
        <a href="contact.html">Contact</a>
        <a href="donate.html" class="btn-nav">Donate</a>
      </nav>

      <!-- MOBILE MENU ICON -->
      <div class="menu-icon" id="menuToggle">☰</div>

  </div>
</header>

<div class="donate-wrapper">
  <div class="donate-card">
    <!-- LEFT: FORM -->
    <div>
      <div class="tag-badge">
        <span class="dot"></span>
        100% donation used for welfare programs
      </div>

      <h1 class="donate-title">Support Subhvaishali Foundation</h1>
      <p class="donate-sub">
        Donate using UPI / QR or Net Banking. Once you pay, submit your payment details here
        along with a screenshot. Our team will verify and send you a receipt & digital certificate.
      </p>

      <p class="donate-steps">
        <span>Step 1:</span> Choose amount & payment mode ·<br>
        <span>Step 2:</span> Pay via UPI / QR or bank transfer ·<br>
        <span>Step 3:</span> Upload screenshot & transaction ID.<br>
      </p>

      <form action="upload_payment.php" method="POST" enctype="multipart/form-data" id="donationForm">
        <div class="form-grid">

          <div>
            <label class="field-label">Full Name *</label>
            <input type="text" name="name" class="field-input" required>
          </div>

          <div>
            <label class="field-label">Email Address *</label>
            <input type="email" name="email" class="field-input" required>
          </div>

          <div>
            <label class="field-label">Phone (optional)</label>
            <input type="text" name="phone" class="field-input">
          </div>

          <div>
            <label class="field-label">Donation Amount (₹) *</label>
            <input type="number" min="1" name="amount" id="amountInput" class="field-input" required
                   value="<?php echo $prefillAmount; ?>">
          </div>

          <!-- PAYMENT METHOD -->
          <div class="form-grid-full">
            <label class="field-label">Payment Method *</label>
            <div class="radio-row">
              <label class="radio-chip active">
                <input type="radio" name="payment_method" value="UPI" checked>
                <span>UPI / QR Code</span>
              </label>
              <label class="radio-chip">
                <input type="radio" name="payment_method" value="NETBANKING">
                <span>Net Banking / IMPS / NEFT</span>
              </label>
            </div>
            <p class="helper-text">
              Choose how you will pay. Once paid, enter the transaction ID and upload the payment screenshot.
            </p>
          </div>

          <!-- TRANSACTION ID (REQUIRED) -->
          <div class="form-grid-full">
            <label class="field-label">Transaction ID *</label>
            <input type="text" name="transaction_id" class="field-input"
                   placeholder="Example: 3245ABCD9876" required>
            <p class="helper-text">
              This is shown in your UPI / bank app after successful payment. Required for verification.
            </p>
          </div>

          <!-- SCREENSHOT (REQUIRED) -->
          <div class="form-grid-full">
            <label class="field-label">Upload Payment Screenshot *</label>
            <div class="upload-box">
              <input type="file" name="screenshot" accept="image/*" required>
              <p class="helper-text" style="margin-top:6px;">
                Upload a clear screenshot showing amount, date, and transaction ID.
              </p>
            </div>
          </div>

          <!-- MESSAGE -->
          <div class="form-grid-full">
            <label class="field-label">Message for the Beneficiaries (optional)</label>
            <textarea name="message" class="field-textarea"
              placeholder="Write a short message of hope, blessings, or support..."></textarea>
          </div>
        </div>

        <div class="btn-row">
          <button type="submit" class="btn-primary">
            <span>Submit Donation Details</span>
            <span>➜</span>
          </button>
        </div>

        <p class="helper-text" style="margin-top:8px;">
          After submitting this form, you’ll receive a confirmation email once your payment is verified.
        </p>
      </form>
    </div>

    <!-- RIGHT: PAYMENT INFO & IMPACT -->
    <div class="sec-right">
      <span class="small-pill">Secure & verified donations</span>
      <h3>How to Pay</h3>
      <p>Select your preferred mode on the left. The details below change automatically.</p>

      <!-- UPI / QR SECTION -->
      <div id="upiSection" class="payment-box">
        <div class="payment-title">Pay via UPI / QR</div>
        <p>Scan the QR or pay using our official UPI ID.</p>

        <div class="upi-flex">
          <div class="qr-wrap">
            <!-- Put your real QR image here -->
            <img src="qr.jpg" alt="UPI QR Code">
          </div>
          <div>
            <div>UPI ID:</div>
            <span class="upi-id" id="upiIdText">subhvaishali@ptaxis</span>
            <p class="helper-text" style="margin-top:4px;">
              Supported apps: GPay · PhonePe · Paytm · BHIM and others.
            </p>

          
          </div>
        </div>
      </div>

      <!-- NET BANKING SECTION -->
      <div id="bankSection" class="payment-box" style="display:none;">
        <div class="payment-title">Pay via Net Banking / IMPS / NEFT</div>
        <p>Use the official foundation bank account:</p>
        <ul class="bank-list">
          <li><b>Account Name:</b> Mayur Subhash Thoke</li>
          <li><b>Account No.:</b> 1100 7558 8750</li>
          <li><b>IFSC:</b> CNRB0001410</li>
          <li><b>Bank:</b> Canara Bank Shrirampur</li>
        </ul>
        <p class="helper-text">
          After transfer, copy the transaction reference number and paste it in the form.
        </p>
      </div>

      <div class="highlight-amount">Every ₹100 you donate can:</div>
      <ul class="benefits-list">
        <li>Provide basic medicines or health support</li>
        <li>Support nutritious food for a family</li>
        <li>Help a child continue their education</li>
      </ul>

      <div class="trust-strip">
        <span><span class="trust-icon">✅</span> Verified receipt on every donation</span>
        <span><span class="trust-icon">📜</span> Digital certificate of appreciation</span>
        <span><span class="trust-icon">🤝</span> Used only for welfare programs</span>
      </div>
    </div>
  </div>
</div>

<script>
  // MOBILE MENU TOGGLE
const menuToggle = document.getElementById("menuToggle");
const mobileMenu = document.getElementById("mobileMenu");

menuToggle.addEventListener("click", () => {
    mobileMenu.classList.toggle("show");
});

// ---------- PAYMENT METHOD TOGGLE ----------
const methodRadios = document.querySelectorAll('input[name="payment_method"]');
const upiSection = document.getElementById('upiSection');
const bankSection = document.getElementById('bankSection');
const radioChips = document.querySelectorAll('.radio-chip');

function updatePaymentView(){
  const checked = document.querySelector('input[name="payment_method"]:checked');
  if(!checked) return;
  const val = checked.value;

  radioChips.forEach(chip => {
    const input = chip.querySelector('input');
    chip.classList.toggle('active', input.checked);
  });

  if(val === 'UPI'){
    upiSection.style.display = 'block';
    bankSection.style.display = 'none';
  }else{
    upiSection.style.display = 'none';
    bankSection.style.display = 'block';
  }
}

methodRadios.forEach(r => r.addEventListener('change', updatePaymentView));
updatePaymentView();


// ---------- UPI Deep Link – opens user's UPI app ----------
document.getElementById('upiPayBtn').addEventListener('click', function(e){
  e.preventDefault();
  var amountField = document.getElementById('amountInput');
  var amount = amountField.value.trim();
  if(!amount || parseInt(amount) <= 0){
    alert('Please enter a valid donation amount first.');
    amountField.focus();
    return;
  }
  var upiId = document.getElementById('upiIdText').textContent.trim();
  var payeeName = encodeURIComponent('Subhvaishali Foundation');

  var url = "upi://pay?pa=" + encodeURIComponent(upiId) +
            "&pn=" + payeeName +
            "&am=" + encodeURIComponent(amount) +
            "&cu=INR";

  window.location.href = url;
});

// ---------- EXTRA VALIDATION (Transaction ID + Screenshot) ----------
document.getElementById('donationForm').addEventListener('submit', function(e){
  const tx = this.transaction_id.value.trim();
  const file = this.screenshot.files[0];

  if(!tx){
    alert('Transaction ID is required.');
    e.preventDefault();
    return;
  }
  if(!file){
    alert('Please upload your payment screenshot.');
    e.preventDefault();
    return;
  }
});
</script>

</body>
</html>
