<?php

use HeaderX\JetstreamInstallers\Facades\Installer;
use HeaderX\JetstreamInstallers\Facades\JetstreamInstallers;
use Illuminate\Support\Str;

it('should show error if file does not exist', function () {
    $response = Installer::insertLine($this->nonExistentFilePath, "", "");

    $this->assertEquals("The file doesn't exists!", $response);
});


it('should show The line already exists', function () {
    $response = Installer::insertLine($this->filepath, "", "2");

    $this->assertEquals("The line already exists", $response);
});

it('should show Line Added after info', function () {
    $lineToAdd = "42";
    $addAfterLine = "2";
    $response = Installer::insertLine($this->filepath, $addAfterLine, $lineToAdd);

    $this->assertEquals("Line Added '$lineToAdd'", $response);
    $this->assertTrue(Str::contains(file_get_contents($this->filepath), "$addAfterLine\n$lineToAdd"));
});

it('should show Line Added before info', function () {
    $lineToAdd = "42";
    $addBeforeLine = "2";
    $response = Installer::insertLine($this->filepath, $addBeforeLine, $lineToAdd, false);

    $this->assertEquals("Line Added '$lineToAdd'", $response);
    $this->assertTrue(Str::contains(file_get_contents($this->filepath), "$lineToAdd\n$addBeforeLine"));
});

it('should show Line Not Added info', function () {
    $lineToAdd = "42";
    $addAfterLine = "NonExistingString";
    $response = Installer::insertLine($this->filepath, $addAfterLine, $lineToAdd, false);

    $this->assertEquals("Unmodified Content. '42' line not added", $response);
});


it('should show Line added after with custom function', function () {
    $lineToAdd = "42";
    $addAfterLine = "2";
    $response = Installer::insertLineAfter($this->filepath, $addAfterLine, $lineToAdd);

    $this->assertEquals("Line Added '$lineToAdd'", $response);
    $this->assertTrue(Str::contains(file_get_contents($this->filepath), "$addAfterLine\n$lineToAdd"));
});

it('should show Line added before with custom function', function () {
    $lineToAdd = "42";
    $addBeforeLine = "2";
    $response = Installer::insertLineBefore($this->filepath, $addBeforeLine, $lineToAdd);

    $this->assertEquals("Line Added '$lineToAdd'", $response);
    $this->assertTrue(Str::contains(file_get_contents($this->filepath), "$lineToAdd\n$addBeforeLine"));
});
