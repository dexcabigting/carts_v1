<div class="m-30">
    <form method="POST" action="{{ route('payment.store') }}">
        @csrf
        <div>
            <h2>Payment Method</h2>
            <div>
                <input type="radio" id="" name="type" value="card">
                <label>Card</label>
            </div>
        </div>

        <div>
            <h2>Card Details</h2>
            <div>
                <label>Card Number</label>
                <input type="text" id="" placeholder="4343434343434345" name="details[card_number]" value="4343434343434345" />
            </div>

            <div>
                <label>Expiration Month</label>
                <input type="text" id="" placeholder="10" name="details[exp_month]" value="10" />
            </div>

            <div>
                <label>Expiration Year</label>
                <input type="text" id="" placeholder="24" name="details[exp_year]" value="24" />
            </div>

            <div>
                <label>CVC</label>
                <input type="text" id="" placeholder="123" name="details[cvc]" value="123" />
            </div>
        </div>

        <br>

        <div>
            <h2>Billing Information</h2>

            <h2>Address</h2>

            <div>
                <label>Line 1</label>
                <input type="text" id="" placeholder="{{ $userAddress->home_address . ',' . $userAddress->barangay }}" name="billing[address][line1]" value="{{ $userAddress->home_address . ',' . $userAddress->barangay }}" />
            </div>

            <div>
                <label>City</label>
                <input type="text" id="" placeholder="{{ $userAddress->city }}" name="billing[address][city]" value="{{ $userAddress->city }}" />
            </div>

            <div>
                <label>State</label>
                <input type="text" id="" placeholder="{{ $userAddress->province }}" name="billing[address][state]" value="{{ $userAddress->province }}" />
            </div>

            <div>
                <label>Country</label>
                <input type="text" id="" placeholder="Philippines" name="billing[address][country]" value="PH" />
            </div>

            <div>
                <label>Postal Code</label>
                <input type="text" id="" placeholder="4005" name="billing[address][postal_code]" value="4005" />
            </div>

            <h2>Contact Information</h2>

            <div>
                <label>Name</label>
                <input type="text" id="" placeholder="{{ auth()->user()->name }}" name="billing[name]" value="{{ auth()->user()->name }}" />
            </div>

            <div>
                <label>Email</label>
                <input type="email" id="" placeholder="{{ auth()->user()->email }}" name="billing[email]" value="{{ auth()->user()->email }}" />
            </div>

            <div>
                <label>Phone</label>
                <input type="text" id="" placeholder="{{ auth()->user()->phone }}" name="billing[phone]" value="{{ auth()->user()->phone }}" />
            </div>
        </div>

        <button type="submit">
            Submit
        </button>
    </form>
</div>
