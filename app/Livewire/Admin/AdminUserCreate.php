<?php

namespace App\Livewire\Admin;

use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminUserCreate extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $profile_image;
    public $name, $email, $password, $nid, $dob, $userId;
    public $isEdit = false;

    protected function rules()
    {
        $id = $this->userId ?? 'NULL';

        $rules = [
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|min:3',
            'email' => 'required|email|unique:admin_user,email,' . $id,
            'nid' => 'nullable|digits_between:10,17|unique:admin_user,nid,' . $id,
            'dob' => 'nullable|date|before:today',
        ];

        if (!$this->isEdit) {
            $rules['password'] = 'required|min:6';
        }

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;

        if ($this->profile_image) {
            $imageName = time() . '.' . $this->profile_image->getClientOriginalExtension();
            $this->profile_image->storeAs('admins', $imageName, 'public');
            $imagePath = 'admins/' . $imageName;
        }

        $user = AdminUser::create([
            'name' => $this->name,
            'email' => $this->email,
            'nid' => $this->nid,
            'dob' => $this->dob,
            'password' => Hash::make($this->password),
            'profile_image' => $imagePath,
            'is_admin' => false,
        ]);

        $this->dispatch('swal:success', data: [
            'title' => $user->name,
            'text' => 'ধন্যবাদ! আপনি Admin হিসাবে সফলভাবে ফর্ম পূরণ করেছেন।'
        ]);

        $this->resetForm();

        return redirect()->route('login');
    }

    public function edit($id)
    {
        $user = AdminUser::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->nid = $user->nid;
        $this->dob = $user->dob;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $user = AdminUser::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'nid' => $this->nid,
            'dob' => $this->dob,
        ]);

        session()->flash('success', 'Admin updated successfully!');
        $this->resetForm();
    }

    public function delete($id)
    {
        AdminUser::findOrFail($id)->delete();
        session()->flash('success', 'Admin deleted successfully.');
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'nid', 'dob', 'userId', 'isEdit', 'profile_image']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.admin-user-create');
    }
}
