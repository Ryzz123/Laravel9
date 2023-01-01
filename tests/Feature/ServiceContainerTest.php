<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertNotNull;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
        // sebelumnya kita menggunakan $foo = new Foo();
        $foo = $this->app->make(Foo::class); // seakan akan new Foo()
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo', $foo->foo());
        self::assertEquals('Foo', $foo2->foo());

        self::assertNotSame($foo, $foo2);
    }

    public function testBind()
    {
        // $person = $this->app->make(Person::class); // new Person()
        // assertNotNull($person);

        $this->app->bind(Person::class, function ($app) {
            return new Person("Febri", "Ananda");
        });

        $person1 = $this->app->make(Person::class); // closure() seakan akan dia melakukan new Person("Febri", "Ananda");
        $person2 = $this->app->make(Person::class); // closure()

        self::assertEquals("Febri", $person1->firstName);
        self::assertEquals("Febri", $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Febri", "Ananda");
        });

        $person1 = $this->app->make(Person::class); // new Person("Febri", "Ananda"); if not exist
        $person2 = $this->app->make(Person::class); // return existing

        self::assertEquals("Febri", $person1->firstName);
        self::assertEquals("Febri", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Febri","Ananda");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person

        self::assertEquals("Febri", $person1->firstName);
        self::assertEquals("Febri", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertEquals('Foo and Bar', $bar1->bar());
        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function ($app){
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Hallo Febri', $helloService->hello('Febri'));
    }


}
