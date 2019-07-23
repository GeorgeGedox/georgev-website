<?php

namespace Tests\Unit;

use App\Setting;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettingsModelTest extends TestCase
{
    use RefreshDatabase;

    public function testAddShouldCreateSetting()
    {
        Setting::add('test', 'test data');

        return $this->assertDatabaseHas('settings', [
            'key' => 'test',
            'value' => 'test data'
        ]);
    }

    public function testShouldSaveArray()
    {
        $data = [
            'key' => 'value',
            'test' => 200,
            'nothing'
        ];

        Setting::add('test', $data, 'array');

        return $this->assertDatabaseHas('settings', [
            'key' => 'test',
            'value' => json_encode($data)
        ]);
    }

    public function testSetShouldUpdateSetting()
    {
        Setting::add('test', 'test data');
        Setting::set('test', 'test update');

        return $this->assertDatabaseHas('settings', [
            'key' => 'test',
            'value' => 'test update'
        ]);
    }

    public function testGetShouldReturnString()
    {
        Setting::add('test', 'test data');
        $this->assertEquals('test data', Setting::get('test'));
    }

    public function testGetShouldReturnInt()
    {
        Setting::add('test', '200', 'int');
        $this->assertIsInt(Setting::get('test'));
    }

    public function testGetShouldReturnBool()
    {
        Setting::add('test', 'true', 'bool');
        $this->assertIsBool(Setting::get('test'));
    }

    public function testGetShouldReturnArray()
    {
        Setting::add('test', [1, 2, 4], 'array');
        $this->assertIsArray(Setting::get('test'));
    }

    public function testRemoveShouldDeleteSetting(){
        Setting::add('test', 'data');
        $this->assertDatabaseHas('settings', [
            'key' => 'test',
            'value' => 'data'
        ]);

        $this->assertTrue(Setting::remove('test'));
        $this->assertDatabaseMissing('settings', [
            'key' => 'test',
            'value' => 'data'
        ]);
    }
}
