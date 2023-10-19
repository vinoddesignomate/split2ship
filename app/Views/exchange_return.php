<style>
    #split_returns_landing_iframe {
        width: 1px;
        min-width: 100%;
        border: 0;
        box-shadow: none;
    }

    .formContainer {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.25rem;
    }

    .headerForm {
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        line-height: 28px;
        color: #202223;
        width: 100%;
        text-overflow: ellipsis;
        overflow: hidden;
        text-align: center;
    }

    .Polaris-Labelled__LabelWrapper {
        word-wrap: break-word;
        word-break: break-word;
        overflow-wrap: break-word;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: baseline;
        margin-bottom: var(--p-space-1);
    }
</style>
<div class="formContainer customInput" style="--bg-color: #000000; --opacity: 0.50; --radius: 24px;">
    <div class="headerForm">Return Center</div>
    <div class="noShadowInputContainer removeTop">
        <div class="">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="order_number_valLabel" for="order_number_val" class="Polaris-Label__Text">Order Number</label></div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="Polaris-TextField"><input id="order_number_val" autocomplete="off" class="Polaris-TextField__Input Polaris-TextField__Input--hasClearButton" type="text" aria-labelledby="order_number_valLabel" aria-invalid="false" value="">
                        <div class="Polaris-TextField__Backdrop"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="noShadowInputContainer removeTop">
        <div class="">
            <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="order_email_valLabel" for="order_email_val" class="Polaris-Label__Text">Email Address</label></div>
            </div>
            <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                    <div class="Polaris-TextField"><input id="order_email_val" autocomplete="off" class="Polaris-TextField__Input Polaris-TextField__Input--hasClearButton" type="email" aria-labelledby="order_email_valLabel" aria-invalid="false" value="">
                        <div class="Polaris-TextField__Backdrop"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><button id="split_exchng" class="_xButton_l3r25_2 _fromLogin_l3r25_22 _block_l3r25_38" disabled="" style="cursor: default;"><span class="_content_l3r25_56"><span>Start Your Return</span></span></button><span style="text-align: center; word-break: break-word;"><span class="Polaris-TextStyle--variationSubdued">You have a maximum of 30 days from the date of your purchase to make a return.</span></span>
    <div class="line"></div><span class="cursor-pointer leading-[24px]">View the full return policy</span>
</div>
<script type="text/javascript">
    const orderNumberInput = document.getElementById('order_number_val');
    const orderEmailInput = document.getElementById('order_email_val');
    const submitButton = document.getElementById('submit_button');

    // Add event listeners to the text input fields
    orderNumberInput.addEventListener('input', checkInputs);
    orderEmailInput.addEventListener('input', checkInputs);

    // Function to check both input fields and enable the button if both have content
    function checkInputs() {
        const orderNumberValue = orderNumberInput.value.trim();
        const orderEmailValue = orderEmailInput.value.trim();

        if (orderNumberValue !== '' && orderEmailValue !== '') {
            submitButton.removeAttribute('disabled');
        } else {
            submitButton.setAttribute('disabled', 'disabled');
        }
    }
</script>