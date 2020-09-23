# PHP

## 1. What is the size of this array? 
```php
$arr = []; 
$arr[8] = 'test';
```

**Answer:** 
  - [X] 1 
  - [ ] 8 
  - [ ] 9


## 2. How many classes are instantiated?
```php
class A { }
class B { }
              
$a = new A(); 
$b = new B();
$c = $b;
```

**Answer:**
  - [ ] 1
  - [X] 2 // $c=$b is copying by reference for PHP4+, no instanciation here 
  - [ ] 3

## 3. What is the output of the following snippets?

A.
```php 
$arr = [3, 1];
foreach ($arr as $item) {
    $item++;
}
$nb = (int) implode('', $arr);
echo $nb;
```

**Answer:** 31 
```php 
// This is because $item++ only affect the local variable $item in the foreach loop which is irrelevant outside of the loop and especially not affecting in anyway the array $arr;
// PHP has no issue here transtyping type from string returned by implode to int as given string is "31", converted int is 31. 
``` 


B.
```php
$a = '1';
$b = &$a;
$b = "4{$b}";
echo $a . ',' . $b++;
```

**Answer:** 41,41
```php 
// & is reference affectation, which means any operation on $b will change the memory reserved area also pointed by $a;
// Here "4{$b}" is just the string "41" when we affect this string to $b we also change $a value to "41". 
// echo $b++ just echo $b before incrementing because "$b++" returns $b then add 1 to $b
// Note : if we wrote echo $a . ',' . ++$b; here it would print 41,42
``` 

## 4. Which PHP code snippet shows an example of Dependency Injection?

A.
```php
class Client 
{
    private $logger;
    
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
```

B.
```php
class Client 
{
    private $logger;
    
    public function __construct()
    {
        $this->logger = new Logger();
    }
}
```

C.
```php
    $client = new Client();
    $logger = new Logger();
    inject($client, $logger);
```

**Answer:**
  - [X] A
  - [ ] B
  - [ ] C


## 5. Name the following design patterns.

#### Design Pattern #1

```php
class MyClass 
{
    public static function newInstance(string: $type): Formatter {
        if ('number' === $type) {
            return new FormatNumber();
        } elseif ('string' === $type) {
            return new FormatString();
        }
    }
}
```
   
**Answer** : This is the Factory design pattern used to given parameters does the job of finding the best class to instanciate. 
   
#### Design Pattern #2   

```php
class MyClass 
{
    private $_stays = [];

    private $_currentIndex = 0;

    public function count(): int
    {
        return count($this->_stays);
    }

    public function current(): Stay
    {
        return $this->_stays[$this->_currentIndex];
    }

    public function key: int
    {
        return $this->_currentIndex;
    }

    public function next()
    {
        return $this->_currentIndex++;
    }

    public function rewind()
    {
        return $this->_currentIndex = 0;
    }

    public function valid(): bool
    {
        return isset($this->_stays[$this->_currentIndex]);
    }
}
```

**Answer** : This is the ITERATOR design pattern, here this class MyClass does implements the Iterator Interface from PHP and it should be added in its declaration. 
It will consequently be able to be iterated other with by the "foreach" keywords for exemple. 
