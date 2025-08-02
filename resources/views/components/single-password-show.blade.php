<!-- 👁️ Show Password Checkbox -->
<div class="mt-2 mb-4">
<label class="inline-flex items-center">
    <input type="checkbox" onclick="togglePassword()" class="form-checkbox text-blue-500">
    <span class="ml-2 text-sm text-gray-700">Show Password</span>
</label>
</div>

<!-- JavaScript Function -->
<script>
  function togglePassword() {
    const passwordInput = document.getElementById('password');
    passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
  }
</script>