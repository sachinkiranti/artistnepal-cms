<?php

namespace Database\Seeders;

use Kiranti\Config\Status;
use Foundation\Models\EmailPattern;
use Foundation\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplateTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        EmailTemplate::insert($this->email_templates());

        EmailPattern::insert($this->email_patterns());

        foreach ($this->email_template_patterns() as $pattern => $templates) :
            $patternID = EmailPattern::where('slug', $pattern)->value('id');
            foreach ($templates as $template) :
                $template = EmailTemplate::where('slug', $template)->first();
                $template->emailPatterns()->attach($patternID);
            endforeach;
        endforeach;
    }

    public function email_template_patterns()
    {
        return [
            '{SITE_NAME}'                 => [
                'email_verification_template',
                'email_welcome_template',
                'reset_password_template',
            ],
            '{USER_NAME}'                 => [
                'email_welcome_template',
            ],
            '{SITE_URL}'                  => [
                'email_verification_template',
                'email_welcome_template',
                'reset_password_template',
            ],
            '{SITE_LOGO}'                 => [
                'email_verification_template',
                'email_welcome_template',
                'reset_password_template',
            ],
            '{USER_VERIFICATION_LINK}'    => [
                'email_verification_template',
            ],
            '{PASSWORD_RESET_TOKEN_LINK}' => [
                'reset_password_template',
            ],
        ];
    }

    private function email_templates()
    {
        return [
            [
                'name' => 'Email Verification Template',
                'slug'          => 'email_verification_template',
                'body'          => 'This is test verification email.',
                'type'          => 1,
                'status'        => Status::ACTIVE_STATUS,
                'created_at'    => now(),
            ],
            [
                'name' => 'Email Welcome Template',
                'slug'          => 'email_welcome_template',
                'body'          => 'This is test welcome email.',
                'type'          => 1,
                'status'        => Status::ACTIVE_STATUS,
                'created_at'    => now(),
            ],
            [
                'name' => 'Email Password Reset Template',
                'slug'          => 'reset_password_template',
                'body'          => 'This is test Password Reset email.',
                'type'          => 1,
                'status'        => Status::ACTIVE_STATUS,
                'created_at'    => now(),
            ],
        ];
    }

    private function email_patterns()
    {
        return [
            [
                'name' => 'Website Name',
                'slug'         => '{SITE_NAME}',
                'status'        => Status::ACTIVE_STATUS,
                'created_at'    => now(),
            ],
            [
                'name' => 'User Name',
                'slug'         => '{USER_NAME}',
                'status'        => Status::ACTIVE_STATUS,
                'created_at'    => now(),
            ],
            [
                'name' => 'Website url',
                'slug'         => '{SITE_URL}',
                'status'        => Status::ACTIVE_STATUS,
                'created_at'    => now(),
            ],
            [
                'name' => 'Website Logo',
                'slug'         => '{SITE_LOGO}',
                'status'        => Status::ACTIVE_STATUS,
                'created_at'    => now(),
            ],
            [
                'name' => 'User Verification Link',
                'slug'         => '{USER_VERIFICATION_LINK}',
                'status'        => Status::ACTIVE_STATUS,
                'created_at'    => now(),
            ],
            [
                'name' => 'Password Reset Token Link',
                'slug'         => '{PASSWORD_RESET_TOKEN_LINK}',
                'status'        => Status::ACTIVE_STATUS,
                'created_at'    => now(),
            ],
        ];
    }

}
