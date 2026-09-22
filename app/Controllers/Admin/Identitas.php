<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteSettingModel;
use App\Models\AdminActivityLogModel;

class Identitas extends BaseController
{
    protected SiteSettingModel $settingModel;

    public function __construct()
    {
        $this->settingModel = new SiteSettingModel();
    }

    /**
     * Display site identity, institutional contact, and social settings.
     */
    public function index(): string
    {
        $settings = SiteSettingModel::getSettings();

        $data = [
            'title'    => 'Pengaturan Identitas & Kontak Institusi - Admin NNSRC',
            'settings' => $settings,
        ];

        return view('admin/identitas/index', $data);
    }

    /**
     * Update site identity, contacts, and socials.
     */
    public function update()
    {
        $rules = [
            'address'       => 'required',
            'address_en'    => 'required',
            'email'         => 'required|valid_email',
            'phone'         => 'required',
            'hours_weekday' => 'required',
            'hours_friday'  => 'required',
            'hours_weekend' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $this->validator->getErrors()));
        }

        $postData = [
            'address'       => trim((string) $this->request->getPost('address')),
            'address_en'    => trim((string) $this->request->getPost('address_en')),
            'email'         => trim((string) $this->request->getPost('email')),
            'phone'         => trim((string) $this->request->getPost('phone')),
            'hours_weekday' => trim((string) $this->request->getPost('hours_weekday')),
            'hours_friday'  => trim((string) $this->request->getPost('hours_friday')),
            'hours_weekend' => trim((string) $this->request->getPost('hours_weekend')),
            'youtube_url'   => trim((string) $this->request->getPost('youtube_url')),
            'instagram_url' => trim((string) $this->request->getPost('instagram_url')),
            'twitter_url'   => trim((string) $this->request->getPost('twitter_url')),
            'linkedin_url'  => trim((string) $this->request->getPost('linkedin_url')),
        ];

        $existing = $this->settingModel->first();
        if ($existing) {
            $this->settingModel->update($existing['id'], $postData);
        } else {
            $postData['id'] = 1;
            $this->settingModel->insert($postData);
        }

        SiteSettingModel::clearSettingsCache();

        AdminActivityLogModel::record(
            'SETTINGS_UPDATE',
            'Memperbarui informasi identitas situs, alamat institusi, jam operasional, dan akun media sosial.'
        );

        return redirect()->to(base_url('admin/identitas'))
            ->with('success', 'Identitas institusi, kontak, dan media sosial berhasil diperbarui!');
    }
}
