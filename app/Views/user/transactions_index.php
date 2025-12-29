<?php include 'layout/header.php'; ?>
<?php include 'layout/navbar.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&family=Space+Grotesk:wght@700&family=Space+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* --- DESIGN REINFORCEMENT --- */
:root {
  --primary: #8b5cf6; 
  --secondary: #ec4899;
  --accent: #00f2fe;
  --dark-bg: #010409;
  --glass: rgba(255, 255, 255, 0.03);
  --glass-border: rgba(255, 255, 255, 0.1);
  --brutal-border: 3px solid #ffffff;
}

body {
  font-family: 'Plus Jakarta Sans', sans-serif;
  background-color: var(--dark-bg);
  background-image: radial-gradient(circle at 50% -20%, #2d1b4e 0%, #010409 60%);
  color: #fff;
  margin: 0;
  overflow-x: hidden;
}

.container { max-width: 1400px; margin: 0 auto; padding: 0 25px; position: relative; z-index: 2; }

/* --- HEADER SECTION --- */
.page-header {
  padding: 120px 0 60px;
  border-bottom: var(--brutal-border);
  background: rgba(0,0,0,0.5);
  backdrop-filter: blur(20px);
  margin-bottom: 50px;
  position: relative;
  z-index: 3;
}

.mega-title {
  font-family: 'Space Grotesk', sans-serif;
  font-size: clamp(3rem, 10vw, 6rem);
  font-weight: 800;
  line-height: 0.8;
  letter-spacing: -4px;
  text-transform: uppercase;
  margin: 0;
}

.header-meta {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  margin-top: 20px;
}

/* --- TRANSACTION LEDGER (LIST) --- */
.ledger-wrapper {
  display: flex;
  flex-direction: column;
  gap: 20px;
  padding-bottom: 100px;
}

.ledger-item {
  background: var(--glass);
  border: var(--brutal-border);
  display: grid;
  grid-template-columns: 80px 2fr 100px 1.5fr 250px;
  transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  position: relative;
  overflow: hidden;
}

.ledger-item:hover {
  transform: scale(1.01) translateX(10px);
  box-shadow: 15px 15px 0px var(--primary);
  background: rgba(255,255,255,0.05);
}

.l-cell {
  padding: 25px 20px;
  border-right: 1px solid var(--glass-border);
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.l-cell:last-child { border-right: none; }

.l-index { background: #fff; color: #000; font-weight: 900; font-size: 1.8rem; align-items: center; border-right: var(--brutal-border); }
.l-event h3 { font-size: 1.5rem; font-weight: 800; text-transform: uppercase; margin: 0; letter-spacing: -1px; line-height: 1; }
.l-event p { color: var(--accent); font-weight: 700; font-size: 0.75rem; margin: 8px 0 0; font-family: 'Space Mono'; }

.l-price { font-family: 'Space Mono', monospace; font-weight: 700; font-size: 1.4rem; color: #fff; }

/* --- STATUS & BADGES --- */
.badge-brutal {
  display: inline-block;
  padding: 6px 12px;
  font-weight: 800;
  font-size: 0.65rem;
  text-transform: uppercase;
  border: 2px solid #fff;
  margin-bottom: 8px;
}
.status-paid { background: #fff; color: #000; }
.status-pending { background: var(--secondary); color: #fff; border-color: #fff; }
.status-refund { background: var(--accent); color: #000; }

/* --- BUTTONS --- */
.btn-brutal {
  padding: 12px 18px;
  border: 2px solid #fff;
  font-weight: 800;
  font-size: 0.7rem;
  text-transform: uppercase;
  cursor: pointer;
  transition: 0.2s;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

.btn-pay { background: var(--primary); color: #fff; box-shadow: 4px 4px 0px #fff; }
.btn-pay:hover { transform: translate(-2px, -2px); box-shadow: 6px 6px 0px #fff; }

.btn-ticket { background: #fff; color: #000; box-shadow: 4px 4px 0px var(--accent); }
.btn-ticket:hover { transform: translate(-2px, -2px); box-shadow: 6px 6px 0px var(--accent); }

/* --- MODAL & VALIDATION STYLE --- */
#bankOverlay {
  position: fixed; 
  inset: 0; 
  background: rgba(0,0,0,0.9); 
  z-index: 9999; 
  display: none; 
  align-items: center; 
  justify-content: center; 
  backdrop-filter: blur(10px);
}
#bankOverlay.show { display: flex; }

.bank-popup {
  background: #000 !important;
  border: var(--brutal-border) !important;
  padding: 30px;
  width: 100%;
  max-width: 450px;
  box-shadow: 15px 15px 0px var(--secondary) !important;
  position: relative;
}

.compact-form-group select, 
.compact-form-group input, 
.compact-form-group textarea {
  width: 100%;
  background: #111 !important;
  border: 2px solid var(--glass-border) !important;
  color: #fff !important;
  border-radius: 0 !important;
  padding: 12px !important;
  margin-bottom: 15px !important;
  font-family: 'Space Mono';
  outline: none;
  box-sizing: border-box;
  transition: 0.3s;
}

/* Neo-Brutalism Validation states */
.compact-form-group input:focus, .compact-form-group textarea:focus {
  border-color: var(--primary) !important;
  box-shadow: 4px 4px 0px var(--primary);
}

.compact-form-group input:invalid:not(:placeholder-shown) {
  border-color: var(--secondary) !important;
}

.compact-form-group input:valid:not(:placeholder-shown) {
  border-color: var(--accent) !important;
}

/* SweetAlert Custom Style */
.swal2-popup {
  background: #000 !important;
  border: 3px solid #fff !important;
  border-radius: 0 !important;
}
.swal2-title, .swal2-html-container {
  color: #fff !important;
  text-transform: uppercase;
  font-family: 'Space Grotesk', sans-serif;
}
.swal2-confirm {
  background: var(--primary) !important;
  border-radius: 0 !important;
  font-weight: 800 !important;
}

/* Mobile responsive */
@media (max-width: 992px) {
  .ledger-item { grid-template-columns: 1fr; }
  .l-cell { border-right: none; border-bottom: 1px solid var(--glass-border); }
  .l-index { display: none; }
}
</style>

<div class="page-header">
  <div class="container">
    <div style="background: var(--secondary); color: #fff; display: inline-block; padding: 5px 15px; font-weight: 900; margin-bottom: 20px; font-size: 0.8rem; letter-spacing: 2px;">
      LOG_SYSTEM // V.03
    </div>
    <h1 class="mega-title animate__animated animate__fadeInDown">MY<br><span style="color: transparent; -webkit-text-stroke: 1.5px #fff;">TRANSACTIONS.</span></h1>
    <div class="header-meta">
      <p style="color: #666; font-weight: 600; text-transform: uppercase; letter-spacing: 2px;">Keep track of your digital passes</p>
      <p style="font-family: 'Space Mono'; font-size: 0.8rem;">TOTAL_ITEMS: [ <?= count($orders) ?> ]</p>
    </div>
  </div>
</div>

<div class="container">
  <div class="ledger-wrapper">
    <?php if (empty($orders)): ?>
      <div class="animate__animated animate__fadeIn" style="text-align:center; padding:100px; border: var(--brutal-border); background: var(--glass);">
        <h2 style="font-weight:900; opacity:0.2; font-size:4rem; margin:0;">NO_DATA_FOUND</h2>
      </div>
    <?php else: $no=1; foreach ($orders as $o): ?>
      <?php 
    // Mengambil data dengan pengaman default null
    $orderStatus   = $o['order_status'] ?? 'pending';
    $refundStatus  = $o['refund_status'] ?? null;
    $ticketCode    = $o['ticket_code'] ?? '';
    $checkinStatus = $o['checkin_status'] ?? null; 

    // 1. PRIORITAS: JIKA SUDAH CHECK-IN
    if ($checkinStatus === 'checked_in') {
        $badge = '<div class="badge-brutal" style="background:#00ff88; color:#000; border-color:#fff;">🎟️ IN GATE</div>';
        $btnAction = '<div style="background:rgba(0,255,136,0.1); padding:10px; border:1px dashed #00ff88; text-align:center;">
                        <small style="color:#00ff88; font-weight:800; font-family:\'Space Mono\'">TICKET_USED</small>
                      </div>';

    // 2. JIKA SEDANG PROSES REFUND (PENAMBAHAN BARU)
    } elseif ($orderStatus === 'refund_pending' || $refundStatus === 'pending') {
        $badge = '<div class="badge-brutal" style="background:#ff9800; color:#000; border-color:#fff;">⏳ REFUND PENDING</div>';
        $btnAction = '<div style="background:rgba(255,152,0,0.1); padding:10px; border:1px dashed #ff9800; text-align:center;">
                        <small style="color:#ff9800; font-weight:800; font-family:\'Space Mono\'">UNDER_REVIEW</small>
                      </div>';

    // 3. JIKA REFUND SELESAI
    } elseif ($refundStatus === 'refunded' || $orderStatus === 'refunded') {
        $badge = '<div class="badge-brutal">💸 REFUNDED</div>';
        $btnAction = '<small style="color:#444; font-weight:800; font-family:\'Space Mono\'">CLOSED</small>';

    // 4. JIKA SUDAH BAYAR (BELUM CHECK-IN / BELUM REFUND)
    } elseif ($orderStatus === 'paid') {
        $badge = '<div class="badge-brutal status-paid">✅ CONFIRMED</div>';
        $btnAction = '
            <div style="display:flex; gap:10px;">
                <button class="btn-brutal btn-ticket" onclick="viewTicket(\''.$ticketCode.'\')">VIEW_TICKET</button>
                <button class="btn-brutal" style="border-color:#444; color:#666;" onclick="openRefund('.$o['id'].')">REFUND</button>
            </div>';

    // 5. JIKA BELUM BAYAR
    } else {
        $badge = '<div class="badge-brutal status-pending">⚠️ UNPAID</div>';
        $btnAction = '
            <div style="display:flex; gap:10px;">
                <button class="btn-brutal btn-pay" onclick="openPay('.$o['id'].')">PAY_NOW</button>
                <button class="btn-brutal" style="border-color:#ff4d4d; color:#ff4d4d" onclick="cancelOrder('.$o['id'].')">CANCEL</button>
            </div>';
    }
?>

      <div class="ledger-item animate__animated animate__fadeInUp">
        <div class="l-cell l-index"><?= sprintf("%02d", $no++) ?></div>
        
        <div class="l-cell l-event">
          <h3><?= esc($o['event_name']) ?></h3>
          <p>#ID-<?= $o['id'] ?>_<?= date('Y') ?></p>
        </div>

        <div class="l-cell" style="align-items: center;">
          <div style="font-size: 0.6rem; color: #666; font-weight: 800; margin-bottom:5px;">QTY</div>
          <div style="font-weight: 900; font-size: 1.5rem;"><?= esc($o['qty']) ?></div>
        </div>

        <div class="l-cell l-price">
          <span style="font-size: 0.6rem; color: #666; font-weight: 800; display: block; margin-bottom: 5px;">TOTAL_BILL</span>
          RP <?= number_format($o['total_price'],0,',','.') ?>
        </div>

        <div class="l-cell" style="border-right: none; align-items: flex-end;">
          <?= $badge ?>
          <div style="margin-top: 5px;">
            <?= $btnAction ?>
          </div>
        </div>
      </div>
    <?php endforeach; endif; ?>
  </div>
</div>

<div id="bankOverlay" onclick="if(event.target==this)closePopup()">
  <div class="bank-popup animate__animated animate__zoomIn animate__faster">
    <h2 id="popupTitle" style="margin:0 0 25px 0; font-weight:900; color:#fff; text-align:center; text-transform: uppercase; font-size: 1.5rem; letter-spacing: -1px;"></h2>
    
    <div id="popupBody"></div>

    <form id="bankForm" method="post" enctype="multipart/form-data" class="compact-form-group">
        <?= csrf_field() ?>
        <input type="hidden" id="orderId" name="order_id">
        <div id="dynamicInputs"></div>
        <button class="btn-brutal btn-pay" id="popupSubmit" type="submit" style="width:100%; margin-top:10px; padding:15px;"></button>
    </form>

    <button class="btn-brutal" style="background: transparent; color: #666; border: 1px solid #222; width:100%; margin-top:10px;" onclick="closePopup()">DISMISS</button>
  </div>
</div>

<script>
const bankOverlay = document.getElementById('bankOverlay');
const bankForm = document.getElementById('bankForm');
const popupBody = document.getElementById('popupBody');
const popupTitle = document.getElementById('popupTitle');
const popupSubmit = document.getElementById('popupSubmit');
const orderIdInput = document.getElementById('orderId');
const dynamicInputs = document.getElementById('dynamicInputs');

const toast = (icon, title) => {
    Swal.fire({
        icon: icon, title: title, toast: true, position: 'top-end',
        showConfirmButton: false, timer: 3000, timerProgressBar: true,
        background: '#000', color: '#fff'
    });
};

function openPopup(title, bodyHtml, showForm = true) {
    popupTitle.innerText = title;
    popupBody.innerHTML = bodyHtml;
    bankForm.style.display = showForm ? 'block' : 'none';
    bankOverlay.classList.add('show');
}

function closePopup() {
    bankOverlay.classList.remove('show');
}

function openPay(id) {
    orderIdInput.value = id;
    dynamicInputs.innerHTML = ''; // RESET INPUT SEBELUMNYA
    bankForm.action = '<?= base_url('user/transactions/pay/store') ?>';
    let html = `<p style="text-align:center; font-size:0.8rem; color:#888; margin-bottom:20px;">UPLOAD PAYMENT PROOF TO CONFIRM</p>`;
    let inputs = `
        <select name="method" required>
            <option value="">-- SELECT METHOD --</option>
            <option value="Transfer">BANK TRANSFER</option>
            <option value="QRIS">QRIS / E-WALLET</option>
        </select>
        <div style="margin:5px 0; font-size:0.65rem; font-weight:800; color:#888;">PAYMENT_PROOF (REQUIRED)</div>
        <input type="file" name="payment_proof" accept="image/*" required>
    `;
    dynamicInputs.innerHTML = inputs;
    popupSubmit.innerText = 'SEND_CONFIRMATION';
    openPopup('💳 EXECUTE_PAYMENT', html, true);
}

function viewTicket(code) {
    const qrUrl = `<?= base_url('user/transactions/qr') ?>/${code}`;
    let html = `
        <div style="text-align:center">
            <div style="background:#fff; padding:15px; border: 4px solid var(--primary); display:inline-block; margin-bottom: 20px;">
                <img src="${qrUrl}" style="width:180px; height:180px; display:block;">
            </div>
            <div style="font-family: 'Space Mono'; background: #111; padding: 12px; border: 1px dashed #444; color: var(--accent); font-size: 1.1rem; font-weight: 700; letter-spacing:2px;">
                ${code}
            </div>
            <p style="font-size: 0.65rem; color: #666; margin-top: 15px; text-transform:uppercase;">Show this code at the gate</p>
        </div>`;
    openPopup('🎟️ DIGITAL_PASS', html, false);
}

function openRefund(id) {
    orderIdInput.value = id;
    dynamicInputs.innerHTML = ''; // RESET INPUT SEBELUMNYA
    bankForm.action = '<?= base_url('user/transactions/refund/store') ?>';
    dynamicInputs.innerHTML = `
        <textarea name="reason" rows="4" placeholder="PLEASE EXPLAIN THE REASON..." required minlength="10"></textarea>
        <div style="background:rgba(236,72,153,0.1); border:1px solid var(--secondary); padding:10px; font-size:0.65rem; color:var(--secondary); font-weight:700;">
            NOTICE: THIS ACTION WILL OVERWRITE ANY PREVIOUS REJECTED DATA.
        </div>
    `;
    popupSubmit.innerText = 'SUBMIT_REQUEST';
    openPopup('↩️ REQUEST_REFUND', '', true);
}

async function cancelOrder(id) {
    Swal.fire({
        title: 'TERMINATE ORDER?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'YES, DELETE',
        cancelButtonText: 'NO, KEEP IT'
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await fetch(`<?= base_url('user/transactions/cancel') ?>/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '<?= csrf_hash() ?>' }
                });
                const res = await response.json();
                if (res.success) location.reload();
            } catch (e) { toast('error', 'SYSTEM_CRASH'); }
        }
    });
}

bankForm.onsubmit = async (e) => {
    e.preventDefault();
    if (!bankForm.checkValidity()) {
        toast('warning', 'PLEASE_FILL_REQUIRED_FIELDS');
        return;
    }
    popupSubmit.disabled = true;
    popupSubmit.innerText = 'EXECUTING...';
    try {
        const response = await fetch(bankForm.action, { 
            method: 'POST', body: new FormData(bankForm) 
        });
        const result = await response.json();
        if(result.success) {
            Swal.fire({
                icon: 'success', title: 'SUCCESS', text: result.message, confirmButtonText: 'OK'
            }).then(() => location.reload());
        } else {
            Swal.fire('ERROR', result.message, 'error');
            popupSubmit.innerText = 'RETRY';
        }
    } catch (error) { toast('error', 'CONNECTION_FAILED'); } finally { popupSubmit.disabled = false; }
};
</script>

<?php include 'layout/footer.php'; ?>