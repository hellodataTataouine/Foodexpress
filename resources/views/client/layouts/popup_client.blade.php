<style>
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: none;
    }

    .popup-content {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 100px;
        z-index: 10000;
        display: none;
    }

    .popup-body {
        text-align: center;
    }

    .popup-close {
        background-color: #f44336;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
    }
    
    .error-message {
        color: red;
        margin-top: 10px;
    }
</style>
@if(!session('showPopup'))
    <!-- Popup Start -->
    <div class="popup-overlay"></div>

    <div class="popup-content" style="height: fit-content;width: 55%;">
        <div class="popup-body">
            <p style="margin-bottom:10px;"><strong>Saisir Votre Code Postal.</strong></p>
            <!-- Postal Code Form -->
            <form method="POST" action="{{ route('validate.postal.code', ['subdomain' => $subdomain]) }}">
                @csrf
                <input type="text" name="postal_code" placeholder="Enter your postal code" style="margin-right:15px;">
                <button type="submit" class="btn-custom primary">Submit</button>
            </form>

            @if(session('codeError'))
                <p class="error-message">{{ session('codeError') }}</p>
            @endif
        </div>
    </div>
@endif

<!-- Popup End -->
