<?php

declare(strict_types=1);

namespace Tests;

use BladeUI\Icons\BladeIconsServiceProvider;
use Daljo25\BladePixelIconIcons\BladePixelIconIconsServiceProvider;
use Orchestra\Testbench\TestCase;

class CompilesIconsTest extends TestCase
{
    /** @test */
    public function it_compiles_an_icon()
    {
        $result = svg('pixelicon-home')->toHtml();

        $this->assertStringContainsString('<svg', $result);
        $this->assertStringContainsString('</svg>', $result);
    }

    /** @test */
    public function it_can_add_classes_to_icons()
    {
        $result = svg('pixelicon-home', 'w-6 h-6 text-gray-500')->toHtml();

        $this->assertStringContainsString('class="w-6 h-6 text-gray-500"', $result);
    }

    /** @test */
    public function it_can_add_attributes_to_icons()
    {
        $result = svg('pixelicon-home', ['style' => 'color: #555'])->toHtml();

        $this->assertStringContainsString('style="color: #555"', $result);
    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            BladePixelIconIconsServiceProvider::class,
        ];
    }
}