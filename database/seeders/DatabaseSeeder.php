<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Policies;
use App\Models\Setting;
use App\Models\Role;
use App\Models\Permission;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user_role = new Role();
		$user_role->slug = 'user';
		$user_role->name = 'User';
		$user_role->save();

		$superadmin = new Role();
		$superadmin->slug = 'superadmin';
		$superadmin->name = 'Super Admin';
		$superadmin->save();

        $superadmin_role = Role::where('slug','superadmin')->first();

		$data = [
			//Acticity
			['slug' => 'read-acticity', 'name' => 'Read Acticity'],
			['slug' => 'create-acticity', 'name' => 'Create Acticity'],
			['slug' => 'update-acticity', 'name' => 'Update Acticity'],
			['slug' => 'delete-acticity', 'name' => 'Delete Acticity'],

			//Banner
			['slug' => 'read-banner', 'name' => 'Read Banner'],
			['slug' => 'create-banner', 'name' => 'Create Banner'],
			['slug' => 'update-banner', 'name' => 'Update Banner'],
			['slug' => 'delete-banner', 'name' => 'Delete Banner'],

			//Sub-extension
			// ['slug' => 'read-subextension', 'name' => 'Read Sub-extension'],
			// ['slug' => 'create-subextension', 'name' => 'Create Sub-extension'],
			// ['slug' => 'update-subextension', 'name' => 'Update Sub-extension'],
			// ['slug' => 'delete-subextension', 'name' => 'Delete Sub-extension'],

			//Category
			['slug' => 'read-category', 'name' => 'Read category'],
			['slug' => 'create-category', 'name' => 'Create category'],
			['slug' => 'update-category', 'name' => 'Update category'],
			['slug' => 'delete-category', 'name' => 'Delete category'],

			//Sub-category
			['slug' => 'read-subcategory', 'name' => 'Read Sub-category'],
			['slug' => 'create-subcategory', 'name' => 'Create Sub-category'],
			['slug' => 'update-subcategory', 'name' => 'Update Sub-category'],
			['slug' => 'delete-subcategory', 'name' => 'Delete Sub-category'],

			// Consult
			['slug' => 'read-consult', 'name' => 'Read Consult'],
			['slug' => 'create-consult', 'name' => 'Create Consult'],
			['slug' => 'update-consult', 'name' => 'Update Consult'],
			['slug' => 'delete-consult', 'name' => 'Delete Consult'],

			// Job
			['slug' => 'read-job', 'name' => 'Read Job'],
			['slug' => 'create-job', 'name' => 'Create Job'],
			['slug' => 'update-job', 'name' => 'Update Job'],
			['slug' => 'delete-job', 'name' => 'Delete Job'],

			// Job
			['slug' => 'read-job-application', 'name' => 'Read Job Application'],
			['slug' => 'create-job-application', 'name' => 'Create Job Application'],
			['slug' => 'update-job-application', 'name' => 'Update Job Application'],
			['slug' => 'delete-job-application', 'name' => 'Delete Job Application'],

			// Listing
			['slug' => 'read-listing', 'name' => 'Read Listing'],
			['slug' => 'create-listing', 'name' => 'Create Listing'],
			['slug' => 'update-listing', 'name' => 'Update Listing'],
			['slug' => 'delete-listing', 'name' => 'Delete Listing'],

			// Listing
			['slug' => 'read-listing-enquiry', 'name' => 'Read Listing Enquiry'],
			['slug' => 'create-listing-enquiry', 'name' => 'Create Listing Enquiry'],
			['slug' => 'update-listing-enquiry', 'name' => 'Update Listing Enquiry'],
			['slug' => 'delete-listing-enquiry', 'name' => 'Delete Listing Enquiry'],

			// Event
			['slug' => 'read-event', 'name' => 'Read Event'],
			['slug' => 'create-event', 'name' => 'Create Event'],
			['slug' => 'update-event', 'name' => 'Update Event'],
			['slug' => 'delete-event', 'name' => 'Delete Event'],

			// Event Enquiry
			['slug' => 'read-event-enquiry', 'name' => 'Read Event Enquiry'],
			['slug' => 'create-event-enquiry', 'name' => 'Create Event Enquiry'],
			['slug' => 'update-event-enquiry', 'name' => 'Update Event Enquiry'],
			['slug' => 'delete-event-enquiry', 'name' => 'Delete Event Enquiry'],

			// Event Banner
			['slug' => 'read-event-banner', 'name' => 'Read Event Banner'],
			['slug' => 'create-event-banner', 'name' => 'Create Event Banner'],
			['slug' => 'update-event-banner', 'name' => 'Update Event Banner'],
			['slug' => 'delete-event-banner', 'name' => 'Delete Event Banner'],


			// Course
			['slug' => 'read-course', 'name' => 'Read Course'],
			['slug' => 'create-course', 'name' => 'Create Course'],
			['slug' => 'update-course', 'name' => 'Update Course'],
			['slug' => 'delete-course', 'name' => 'Delete Course'],

			// Course Content
			['slug' => 'read-course-content', 'name' => 'Read Course Content'],
			['slug' => 'create-course-content', 'name' => 'Create Course Content'],
			['slug' => 'update-course-content', 'name' => 'Update Course Content'],
			['slug' => 'delete-course-content', 'name' => 'Delete Course Content'],

			// // User Course 
			// ['slug' => 'read-user-course', 'name' => 'Read User Course'],
			// ['slug' => 'create-user-course', 'name' => 'Create User Course'],
			// ['slug' => 'update-user-course', 'name' => 'Update User Course'],
			// ['slug' => 'delete-user-course', 'name' => 'Delete User Course'],

			// Course Review 
			['slug' => 'read-course-review', 'name' => 'Read Course Review'],
			['slug' => 'create-course-review', 'name' => 'Create Course Review'],
			['slug' => 'update-course-review', 'name' => 'Update Course Review'],
			['slug' => 'delete-course-review', 'name' => 'Delete Course Review'],

			//Blog
			['slug' => 'read-blog', 'name' => 'Read Blog'],
			['slug' => 'create-blog', 'name' => 'Create Blog'],
			['slug' => 'update-blog', 'name' => 'Update Blog'],
			['slug' => 'delete-blog', 'name' => 'Delete Blog'],

			//Blog-category
			['slug' => 'read-blogcategory', 'name' => 'Read Blog-category'],
			['slug' => 'create-blogcategory', 'name' => 'Create Blog-category'],
			['slug' => 'update-blogcategory', 'name' => 'Update Blog-category'],
			['slug' => 'delete-blogcategory', 'name' => 'Delete Blog-category'],

			//Blog Tag
			['slug' => 'manage-blogtag', 'name' => 'Read Blog Tags'],

			//News
			['slug' => 'read-news', 'name' => 'Read News'],
			['slug' => 'create-news', 'name' => 'Create News'],
			['slug' => 'update-news', 'name' => 'Update News'],
			['slug' => 'delete-news', 'name' => 'Delete News'],

			//Video Gallery
			['slug' => 'read-video', 'name' => 'Read Video Gallery'],
			['slug' => 'create-video', 'name' => 'Create Video Gallery'],
			['slug' => 'update-video', 'name' => 'Update Video Gallery'],
			['slug' => 'delete-video', 'name' => 'Delete Video Gallery'],

			//Image Gallery
			['slug' => 'read-image', 'name' => 'Read Image Gallery'],
			['slug' => 'create-image', 'name' => 'Create Image Gallery'],
			['slug' => 'update-image', 'name' => 'Update Image Gallery'],
			['slug' => 'delete-image', 'name' => 'Delete Image Gallery'],

			//Notification
			// ['slug' => 'read-notification', 'name' => 'Read Notification'],
			// ['slug' => 'create-notification', 'name' => 'Create Notification'],
			// ['slug' => 'update-notification', 'name' => 'Update Notification'],
			// ['slug' => 'delete-notification', 'name' => 'Delete Notification'],

			//Role
			['slug' => 'read-role', 'name' => 'Read Role & Permission'],
			['slug' => 'create-role', 'name' => 'Create Role & Permission'],
			['slug' => 'update-role', 'name' => 'Update Role & Permission'],
			['slug' => 'delete-role', 'name' => 'Delete Role & Permission'],

			//Staff
			['slug' => 'read-staff', 'name' => 'Read Staff'],
			['slug' => 'create-staff', 'name' => 'Create Staff'],
			['slug' => 'update-staff', 'name' => 'Update Staff'],
			['slug' => 'delete-staff', 'name' => 'Delete Staff'],

			//User
			['slug' => 'read-user', 'name' => 'Read User'],
			['slug' => 'create-user', 'name' => 'Create User'],
			['slug' => 'update-user', 'name' => 'Update User'],
			['slug' => 'delete-user', 'name' => 'Delete User'],

			//Setting
			['slug' => 'update-setting', 'name' => 'Update Setting'],

			//Policy
			['slug' => 'update-policy', 'name' => 'Update Policy'],

			//Read Enquiry
			['slug' => 'read-Enquiry', 'name' => 'Read Enquiry'],
			['slug' => 'delete-Enquiry', 'name' => 'Delete Enquiry'],

			//Read Donation
			['slug' => 'read-donation', 'name' => 'Read Donation'],
			['slug' => 'delete-donation', 'name' => 'Delete Donation'],

			//Reporting
			['slug' => 'global-read-report', 'name' => 'Global Read Report'],
			['slug' => 'read-report', 'name' => 'Read Report'],
		];

		foreach($data as $d)
		{
			$superadmin_permission = new Permission();
			$superadmin_permission->slug = $d['slug'];
			$superadmin_permission->name = $d['name'];
			$superadmin_permission->save();
			$superadmin_permission->roles()->attach($superadmin_role);
		}
		
        $superadmin_perm = Permission::get();

        $user = new User();
        $user->name = "Admin";
        $user->email = "demo@haxways.com";
        $user->username = "haxways";
        $user->password = Hash::make("12345678");
        $user->save();
        $user->roles()->attach($superadmin_role);
		$user->permissions()->attach($superadmin_perm);

        $policy = new Policies();
        $policy->term = "Terms And Conditions";
        $policy->policy = "Privacy Policy";
        $policy->refund = "Refund Policy";
        $policy->save();


        $setting = new Setting();
        $setting->save();
    }
}
