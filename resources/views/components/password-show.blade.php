 <!-- 👁️ Show Password Checkbox -->
<div class="mt-2 mb-4">
    <label class="inline-flex items-center">
        <input type="checkbox" onclick="togglePasswordVisibility()" class="form-checkbox text-blue-500">
        <span class="ml-2 text-sm text-gray-700">পাসওয়ার্ড দেখান</span>
    </label>
</div>
<script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const confirmField = document.getElementById('password_confirmation');
            const fields = [passwordField, confirmField];

            fields.forEach(field => {
            field.type = field.type === 'password' ? 'text' : 'password';
            });
        }
</script>