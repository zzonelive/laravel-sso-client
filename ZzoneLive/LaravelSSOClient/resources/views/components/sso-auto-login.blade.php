<iframe id="ssoLoginFrame" src="{{ $ssoUrl }}" style="display:none;"></iframe>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const allowedOrigin = "{{ $origin }}";

        window.addEventListener("message", function(event) {
            if (event.origin !== allowedOrigin) {
                console.warn(`Untrusted origin: ${event.origin}`);
                return;
            }

            const data = event.data;

            if (data.logged_in) {
                console.log('User is logged in:', data.user);

                if (!localStorage.getItem('isCheckedLoggedIn')) {
                    fetch('/auto-login', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(data.user)
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(result => {
                            console.log('Auto-login response:', result);
                            if (result.message === 'Auto-login successful') {
                                localStorage.setItem('isCheckedLoggedIn', true);
                                location.reload();
                            } else {
                                console.log('Auto-login failed:', result.message);
                            }
                        })
                        .catch(error => {
                            console.error('Auto-login failed:', error);
                        });
                }
            } else {
                console.log('User is not logged in.');
            }
        });
    });
</script>

@if (!Auth::check())
    <script>
        localStorage.removeItem('isCheckedLoggedIn');
        console.log("remove isCheckedLoggedIn");
    </script>
@endif
