# Relations

## Querying Relationship Existence

```php
// Retrieve all posts that have at least one comment...
$posts = $repository->match(Spec::hasX('comments'));

// Retrieve all posts that have three or more comments...
$posts = $repository->match(Spec::hasX('comments', '>=', 3));

// Retrieve all posts that have at least one comment with votes...
$posts = $repository->match(Spec::hasX('comments.votes'));

// Retrieve all posts with at least one comment containing words like foo%
$posts = $repository->match(Spec::hasX('comments', '>=', 1, 'and', [
    Spec::where('content', 'like', 'foo%')
]));
```

## Querying Relationship Absence

```php
$posts = $repository->match(Spec::doesntHaveX('comment'));

$posts = $repository->match(Spec::doesntHaveX('comment.votes'));

$posts = $repository->match(Spec::doesntHaveX('comments', 'and', [
    Spec::where('content', 'like', 'foo%')
]));
```

## Counting Related Models

```php
$posts = $repository->match(Spec::withCount('comments'));

foreach ($posts as $post) {
    echo $post->comments_count;
}
```

**Note: For now there are available only relations (not closures specified queries)**

## Eager Loading

```php
$books = $repository->match(Spec::with('author'));

// Multiple relationships
$books = $repository->match(Spec::with(['author', 'publisher']));

// Nested relationships
$books = $repository->match(Spec::with('author.contacts'));

// Specific columns
$books = $repository->match(Spec::with('author:id,name'));
```

**Note: For now there are available only relations (not closures specified queries)**

# Inserting & Updating Related Models

## The Save Action

```php
$repository = new PostRepository();

$comment = new App\Comment(['message' => 'A new comment.']);

$post = $repository->find(1);

$repository->model($post, Act::save());
        
$repository->model($post, Act::save(['timestamps' => false]));

$repository->model($post, Act::saveRelation('comments', $comment));
```

## The SaveMany Action

```php
$post = $repository->find(1);

$repository->model($post, Act::saveMany('comments', [
    new App\Comment(['message' => 'A new comment.']),
    new App\Comment(['message' => 'Another comment.']),
]));
```

## The Create Action

```php
$post = $repository->find(1);

$repository->model($post, Act::create('comments', [
    'message' => 'A new comment.',
]));
```

## The CreateMany Action

```php
$post = $repository->find(1);

$repository->model($post, Act::createMany('comments', [
    [
        'message' => 'A new comment.',
    ],
    [
        'message' => 'Another new comment.',
    ],
]));
```

## Belongs To Relationships

```php
$account = $repository->find(10);

$repository->model($user, Act::associate('account', $account));

$repository->model($user, Act::dissociate('account'));
```

## Many-To-Many Relationships

### Attaching / Detaching

```php
$user = $repository->find(10);

$repository->model($user, Act::attach('roles', $roleId));

// With additional pivot data
$repository->model($user, Act::attach('roles', $roleId, ['expires' => $expires]));

// Detach all
$repository->model($user, Act::detach('roles'));

// Detach some
$repository->model($user, Act::detach('roles', [$roleId]));
```

### Syncing associations

```php
$repository->model($user, Act::sync('roles', [1, 2, 3]));

$repository->model($user, Act::sync('roles', [1 => ['expires' => true], 2, 3]));

$repository->model($user, Act::syncWithoutDetaching('roles', [1, 2, 3]));
```

### Toggling Associations

```php
$repository->model($user, Act::toggle('roles', [1, 2, 3]));
```

### Saving Additional Data On A Pivot Table

```php
$repository->model($user, Act::saveRelation('roles', $role, ['expires' => $expires]));
```

### Updating Existing Pivot

```php
$repository->model($user, Act::updateExistingPivot('roles', $roleId, ['expires' => $expires]));
```

