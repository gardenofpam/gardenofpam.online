<div x-data="messageModal()" x-cloak>

    {{-- Backdrop --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"
         style="background:rgba(6,27,14,0.5);"
         class="fixed inset-0 z-50 backdrop-blur-sm">
    </div>

    {{-- Modal --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="fixed inset-0 z-50 flex items-center justify-center p-4">

        <div @click.stop
             style="background:#FAF9F5;
                    border-radius:16px;
                    border:1px solid rgba(6,27,14,0.08);
                    max-height:90vh;
                    overflow-y:auto;"
             class="w-full max-w-md p-8 shadow-arb-hover">

            {{-- Header --}}
            <div class="flex justify-between items-start mb-8">
                <div>
                    <p class="section-label mb-1"
                       x-text="step === 1 ? 'Leave a note' : 'Verify your email'">
                    </p>
                    <h2 class="font-serif text-2xl font-semibold"
                        style="color:#061B0E;"
                        x-text="step === 1 ? 'Plant a Message' : 'Enter OTP Code'">
                    </h2>
                </div>
                <button @click="open = false"
                        style="color:rgba(6,27,14,0.3);"
                        class="hover:opacity-70 transition-opacity mt-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Error Message --}}
            <div x-show="errorMsg"
                 x-text="errorMsg"
                 style="background:rgba(220,38,38,0.08);
                        border:1px solid rgba(220,38,38,0.20);
                        color:#dc2626;
                        border-radius:10px;
                        font-size:13px;"
                 class="px-4 py-3 mb-5">
            </div>

            {{-- Success Message --}}
            <div x-show="successMsg"
                 x-text="successMsg"
                 style="background:rgba(74,124,89,0.08);
                        border:1px solid rgba(74,124,89,0.20);
                        color:#4A7C59;
                        border-radius:10px;
                        font-size:13px;"
                 class="px-4 py-3 mb-5">
            </div>

            {{-- ═══════════════════════════ --}}
            {{-- STEP 1: Message Form        --}}
            {{-- ═══════════════════════════ --}}
            <div x-show="step === 1">
                <div class="space-y-5">

                    {{-- Name --}}
                    <div>
                        <label class="section-label block mb-2">Your Name</label>
                        <input type="text"
                               x-model="form.sender_name"
                               placeholder="Juan dela Cruz"
                               style="background:#F5F0E8;
                                      border:1px solid rgba(6,27,14,0.10);
                                      border-radius:10px;
                                      color:#061B0E;"
                               class="w-full px-4 py-3 text-sm focus:outline-none transition-colors">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="section-label block mb-2">Email Address</label>
                        <input type="email"
                               x-model="form.sender_email"
                               placeholder="juan@email.com"
                               style="background:#F5F0E8;
                                      border:1px solid rgba(6,27,14,0.10);
                                      border-radius:10px;
                                      color:#061B0E;"
                               class="w-full px-4 py-3 text-sm focus:outline-none transition-colors">
                    </div>

                    {{-- Subject --}}
                    <div>
                        <label class="section-label block mb-2">Subject</label>
                        <input type="text"
                               x-model="form.subject"
                               placeholder="Hello Paul!"
                               style="background:#F5F0E8;
                                      border:1px solid rgba(6,27,14,0.10);
                                      border-radius:10px;
                                      color:#061B0E;"
                               class="w-full px-4 py-3 text-sm focus:outline-none transition-colors">
                    </div>

                    {{-- Message --}}
                    <div>
                        <label class="section-label block mb-2">Message</label>
                        <textarea x-model="form.body"
                                  rows="4"
                                  placeholder="Your message here..."
                                  style="background:#F5F0E8;
                                         border:1px solid rgba(6,27,14,0.10);
                                         border-radius:10px;
                                         color:#061B0E;"
                                  class="w-full px-4 py-3 text-sm focus:outline-none transition-colors resize-none"></textarea>
                    </div>

                    {{-- Note --}}
                    <p style="color:rgba(6,27,14,0.35); font-size:12px; line-height:1.6;">
                        A 6-digit OTP code will be sent to your email to verify
                        your identity before the message is delivered.
                    </p>

                    {{-- Submit --}}
                    <button @click="sendOtp()"
                            :disabled="loading"
                            style="background:#061B0E;
                                   color:#FAF9F5;
                                   border-radius:10px;"
                            class="w-full py-3 px-4 text-sm font-medium tracking-wide hover:opacity-90 transition-opacity disabled:opacity-50">
                        <span x-show="!loading">Send Verification Code →</span>
                        <span x-show="loading">Sending...</span>
                    </button>

                </div>
            </div>

            {{-- ═══════════════════════════ --}}
            {{-- STEP 2: OTP Verification    --}}
            {{-- ═══════════════════════════ --}}
            <div x-show="step === 2">
                <div class="space-y-5">

                    {{-- Info --}}
                    <div style="background:#F5F0E8;
                                border:1px solid rgba(6,27,14,0.08);
                                border-radius:10px;"
                         class="px-4 py-4">
                        <p style="color:rgba(6,27,14,0.50); font-size:13px; line-height:1.6;">
                            We sent a 6-digit code to
                            <strong x-text="form.sender_email"
                                    style="color:#061B0E;"></strong>.
                            Enter it below to complete sending your message.
                        </p>
                    </div>

                    {{-- OTP Input --}}
                    <div>
                        <label class="section-label block mb-2">
                            6-Digit OTP Code
                        </label>
                        <input type="text"
                               x-model="otp"
                               maxlength="6"
                               placeholder="000000"
                               style="background:#F5F0E8;
                                      border:1px solid rgba(6,27,14,0.10);
                                      border-radius:10px;
                                      color:#061B0E;
                                      font-size:24px;
                                      font-weight:700;
                                      letter-spacing:0.3em;
                                      text-align:center;"
                               class="w-full px-4 py-4 focus:outline-none transition-colors">
                    </div>

                    {{-- Verify Button --}}
                    <button @click="verifyOtp()"
                            :disabled="loading || otp.length !== 6"
                            style="background:#061B0E;
                                   color:#FAF9F5;
                                   border-radius:10px;"
                            class="w-full py-3 px-4 text-sm font-medium tracking-wide hover:opacity-90 transition-opacity disabled:opacity-50">
                        <span x-show="!loading">Verify & Send Message →</span>
                        <span x-show="loading">Verifying...</span>
                    </button>

                    {{-- Resend --}}
                    <div class="text-center">
                        <button @click="resendOtp()"
                                :disabled="loading"
                                style="color:rgba(6,27,14,0.40);
                                       font-size:13px;
                                       background:none;
                                       border:none;
                                       cursor:pointer;"
                                class="hover:opacity-70 transition-opacity">
                            Didn't receive the code? Resend →
                        </button>
                    </div>

                    {{-- Back --}}
                    <div class="text-center">
                        <button @click="step = 1; otp = ''; errorMsg = ''"
                                style="color:rgba(6,27,14,0.30);
                                       font-size:12px;
                                       background:none;
                                       border:none;
                                       cursor:pointer;"
                                class="hover:opacity-70 transition-opacity">
                            ← Go back and edit message
                        </button>
                    </div>

                </div>
            </div>

            {{-- ═══════════════════════════ --}}
            {{-- STEP 3: Success             --}}
            {{-- ═══════════════════════════ --}}
            <div x-show="step === 3" class="text-center py-4">

                <div style="width:64px; height:64px;
                            background:rgba(74,124,89,0.10);
                            border:1px solid rgba(74,124,89,0.20);
                            border-radius:50%;
                            margin:0 auto 20px;"
                     class="flex items-center justify-center">
                    <svg style="width:28px; height:28px; color:#4A7C59;"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="1.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

                <p class="section-label mb-3">Message Delivered</p>

                <h3 class="font-serif text-2xl font-bold mb-3"
                    style="color:#061B0E;">
                    Message Sent!
                </h3>

                <p style="color:rgba(6,27,14,0.50); font-size:14px; line-height:1.6;"
                   class="mb-8">
                    Your message has been verified and delivered successfully.
                    Paul will get back to you soon.
                </p>

                <button @click="open = false; resetForm()"
                        style="background:#061B0E;
                               color:#FAF9F5;
                               border-radius:10px;"
                        class="px-6 py-3 text-sm font-medium hover:opacity-90 transition-opacity">
                    Close
                </button>

            </div>

        </div>
    </div>
</div>

<script>
function messageModal() {
    return {
        open: false,
        step: 1,
        niche: '',
        loading: false,
        errorMsg: '',
        successMsg: '',
        otp: '',
        messageId: null,
        form: {
            sender_name:  '',
            sender_email: '',
            subject:      '',
            body:         '',
        },

        getCsrf() {
            const meta = document.querySelector('meta[name="csrf-token"]');
            return meta ? meta.getAttribute('content') : '';
        },

        init() {
            window.addEventListener('open-message-modal', (e) => {
                this.niche = e.detail.niche;
                this.open  = true;
                this.resetForm();
            });
        },

        resetForm() {
            this.step       = 1;
            this.otp        = '';
            this.errorMsg   = '';
            this.successMsg = '';
            this.messageId  = null;
            this.loading    = false;
            this.form = {
                sender_name:  '',
                sender_email: '',
                subject:      '',
                body:         '',
            };
        },

        async sendOtp() {
            this.errorMsg   = '';
            this.successMsg = '';

            if (!this.form.sender_name ||
                !this.form.sender_email ||
                !this.form.subject ||
                !this.form.body) {
                this.errorMsg = 'Please fill in all fields.';
                return;
            }

            this.loading = true;

            try {
                const response = await fetch('/message/send-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type':  'application/json',
                        'Accept':        'application/json',
                        'X-CSRF-TOKEN':  this.getCsrf(),
                    },
                    body: JSON.stringify({
                        from_niche:   this.niche,
                        sender_name:  this.form.sender_name,
                        sender_email: this.form.sender_email,
                        subject:      this.form.subject,
                        body:         this.form.body,
                    }),
                });

                const data = await response.json();

                if (data.success) {
                    this.messageId = data.message_id;
                    this.step      = 2;
                } else {
                    this.errorMsg = data.error || 'Something went wrong.';
                }
            } catch (e) {
                console.error(e);
                this.errorMsg = 'Network error: ' + e.message;
            }

            this.loading = false;
        },

        async verifyOtp() {
            this.errorMsg   = '';
            this.successMsg = '';
            this.loading    = true;

            try {
                const response = await fetch('/message/verify-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type':  'application/json',
                        'Accept':        'application/json',
                        'X-CSRF-TOKEN':  this.getCsrf(),
                    },
                    body: JSON.stringify({
                        message_id: this.messageId,
                        otp:        this.otp,
                    }),
                });

                const data = await response.json();

                if (data.success) {
                    this.step = 3;
                } else {
                    this.errorMsg = data.error || 'Invalid OTP. Please try again.';
                }
            } catch (e) {
                console.error(e);
                this.errorMsg = 'Network error: ' + e.message;
            }

            this.loading = false;
        },

        async resendOtp() {
            this.errorMsg   = '';
            this.successMsg = '';
            this.loading    = true;

            try {
                const response = await fetch('/message/resend-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type':  'application/json',
                        'Accept':        'application/json',
                        'X-CSRF-TOKEN':  this.getCsrf(),
                    },
                    body: JSON.stringify({
                        message_id: this.messageId,
                    }),
                });

                const data = await response.json();

                if (data.success) {
                    this.successMsg = 'New OTP sent to your email!';
                    this.otp        = '';
                } else {
                    this.errorMsg = data.error || 'Something went wrong.';
                }
            } catch (e) {
                console.error(e);
                this.errorMsg = 'Network error: ' + e.message;
            }

            this.loading = false;
        },
    }
}
</script>