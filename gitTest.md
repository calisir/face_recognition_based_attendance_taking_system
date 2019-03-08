# GIT Usage

Branch is one of the most important usage of GIT. It allows us to create as many branches as we want without any cost.

**Why we need it ?** </br>
In some cases we would like to try our new concept such as a new face detection algorithm or a new layout for our attendance system.
Then of course we wouldn't download the whole system again and again. </br>
Rather we will just work on our own workspace then we will commit them if we like to.
Also, it is hard to trace which changes have been made.

*Let's start*

    $ git branch # Show branches in our repo
    * master
GIT shows us our workspace which is **master** branch. Now lets assume an idea came to our mind regarding attendance.

    $ git branch idea # Create new branch called attendance
    $ git branch
      attendance
    * master

'*' indicates the branch we are in. Now lets switch to our new **atendance** branch.
    
    $ git checkout attendance
    Switched to branch 'attendance'

This is our playground. Now lets add some AB testing file.
    
    $ touch testing-file-ab-{1,2}.sh
    $ git add . # Adding all files to staging area
    $ git commit -m 'added 2 test files'
    [attendance d078535] added 2 test files
    2 files changed, 0 insertions(+), 0 deletions(-)
    create mode 100644 testing-file-ab-1.sh
    create mode 100644 testing-file-ab-2.sh

    
    $ ls
    attendance  testing-file-ab-1.sh  testing-file-ab-2.sh

    
    $ git log --graph --decorate --oneline --all
    
    * d078535 (HEAD -> attendance) added 2 test files
    | * d4a8863 (deneme) added 2 test files
    |/  
    * ed17ee8 (origin/master, origin/HEAD, master) topnav added.
    * b276a80 some pages added
    * fd9607f upload page updated,minor changes in attendance page.
    * 270327b added attendance page
    * ad9c33f php files for upload page
    * 0f8bb8d php files


Please note that our workspace **attendance** is our(*HEAD*)
Now lets roll to the master branch get directory list.

    $ git checkout master
    Switched to branch 'master'
    
    $ ls
    
    attendance


    $ git diff HEAD idea --name-only # git help diff
    
    testing-file-ab-1.sh
    testing-file-ab-2.sh

In our master branch we don't have `testing-file-ab-1.sh` and
`testing-file-ab-2.sh` files.

Now, in order to move these 2 files to our **master** branch from **attendance** branch we have to **merge**.

# Merging Branches: `git merge`

First, we have to go back to our **master** branch.


## Strategy: Fast-Forward

    $ git log --graph --decorate --oneline --all
    
    * d078535 (attendance) added 2 test files
    | * d4a8863 (deneme) added 2 test files
    |/  
    * ed17ee8 (HEAD -> master, origin/master, origin/HEAD) topnav added.
    * b276a80 some pages added
    * fd9607f upload page updated,minor changes in attendance page.
    * 270327b added attendance page
    * ad9c33f php files for upload page
    * 0f8bb8d php files

    
    $ git checkout master # Move the branch that you'll update
    $ git merge attendance      # Take attendance branch differences to master branch
    
    Updating ed17ee8..d078535
    Fast-forward
     testing-file-ab-1.sh | 0
     testing-file-ab-2.sh | 0
     2 files changed, 0 insertions(+), 0 deletions(-)
     create mode 100644 testing-file-ab-1.sh
     create mode 100644 testing-file-ab-2.sh

    $ git log --graph --decorate --oneline --all
    
    * d078535 (HEAD -> master, attendance) added 2 test files
    | * d4a8863 (deneme) added 2 test files
    |/  
    * ed17ee8 (origin/master, origin/HEAD) topnav added.
    * b276a80 some pages added
    * fd9607f upload page updated,minor changes in attendance page.
    * 270327b added attendance page
    * ad9c33f php files for upload page
    * 0f8bb8d php files

Both **master and **attendance** branches shows the same point. As suggested, we delete after our merge we delete **attendance** branch.

    $ git branch -d idea
    Deleted branch attendance (was d078535).

    $ git branch -v
    * master d078535 [ahead 1] added 2 test files

## Strategy: Recursive
Let's create another branch from master.

    $ git checkout -b development           # This both creates and switches to new branch
    Switched to a new branch 'development'

Add new file:

    $ touch attendance.js && git add attendance.js
    $ git commit -m 'attendance js file added'
    
    [development 96e7ae4] attendance js file added
    1 file changed, 0 insertions(+), 0 deletions(-)
    create mode 100644 attendance.js
     
    $ git log --graph --decorate --oneline --all
    
    * 96e7ae4 (HEAD -> development) attendance js file added
    * d078535 (master) added 2 test files
    * ed17ee8 (origin/master, origin/HEAD) topnav added.
    * b276a80 some pages added
    * fd9607f upload page updated,minor changes in attendance page.
    * 270327b added attendance page
    * ad9c33f php files for upload page
    * 0f8bb8d php files

Now at the same time lets go to main branch and add some server files:

    $ git checkout master
    Switched to branch 'master'
    
    $ touch server-{1,2}.rb && git add server-{1,2}.rb
    $ git commit -m 'server files added'
    
    [master 3c1e20a] server files added
    2 files changed, 0 insertions(+), 0 deletions(-)
    create mode 100644 server-1.rb
    create mode 100644 server-2.rb
     
     $ git log --graph --decorate --oneline --all
     
     * 3c1e20a (HEAD -> master) server files added
    | * 96e7ae4 (development) attendance js file added
    |/  
    * d078535 added 2 test files
    * ed17ee8 (origin/master, origin/HEAD) topnav added.
    * b276a80 some pages added
    * fd9607f upload page updated,minor changes in attendance page.
    * 270327b added attendance page
    * ad9c33f php files for upload page
    * 0f8bb8d php files

From `d078535` we have created 2 new commits which are:

1. `96e7ae4 (development) attendance js file added`
1. `3c1e20a (HEAD -> master) server files added`

which means `2546539c16e9` is the ancestor of `96e7ae4` ve `3c1e20a` commits.

    $ git show --pretty=%h 96e7ae4^ # git help show
    d078535

    diff --git a/testing-file-ab-1.sh b/testing-file-ab-1.sh
    new file mode 100644
    index 0000000..e69de29
    diff --git a/testing-file-ab-2.sh b/testing-file-ab-2.sh
    new file mode 100644
    index 0000000..e69de29

    
    $ git show --pretty=%h 3c1e20a^
    d078535

    diff --git a/testing-file-ab-1.sh b/testing-file-ab-1.sh
    new file mode 100644
    index 0000000..e69de29
    diff --git a/testing-file-ab-2.sh b/testing-file-ab-2.sh
    new file mode 100644
    index 0000000..e69de29


Now let's summarize:
1. 2 files in master branch: `server-1.rb` ve `server-2.rb` is not available in development branch
1. `global.js` file in development branch is not available in master branch.

To move changes in development branch to our master branch:

    $ git checkout master
    Switched to branch 'master'
    
    $ git merge development

At this point we are in a VIM like editor.

    Merge branch 'development'

    # Please enter a commit message to explain why this merge is necessary,
    # especially if it merges an updated upstream into a topic branch.
    #
    # Lines starting with '#' will be ignored, and an empty message aborts
    # the commit.

We quit without doing anything ':wq'

    Merge made by the 'recursive' strategy.
    attendance.js | 0
    1 file changed, 0 insertions(+), 0 deletions(-)
    create mode 100644 attendance.js

     
     $ git log --graph --decorate --oneline --all
     
     *   5424468beb69 (HEAD -> master) Merge branch 'development'
     |\  
     | * 7e3c5612484b (development) main js file added
     * | e2fba879b0df server files added
     |/  
     * 2546539c16e9 testing commit
     * b34155b6b819 added 2 test files
     * 1304ac22cd97 Example commit
     * 258f67c2e2cd [root] Initial commit

Now we have **merge bubble** made with Recursive strategy.

    5424468beb69 (HEAD -> master) Merge branch 'development'

Pro/Con for being a recursive:
In the previous Fast Forward strategy after our merge we deleted our branch.
Now lets delete development branch and check the logs.

    $ git branch -d development
    Deleted branch development (was 96e7ae4).
    
    $ git log --graph --decorate --oneline --all
    
    *   bbec6da (HEAD -> master) Merge branch 'development'
    |\  
    | * 96e7ae4 attendance js file added
    * | 3c1e20a server files added
    |/  
    * d078535 added 2 test files
    * ed17ee8 (origin/master, origin/HEAD) topnav added.
    * b276a80 some pages added
    * fd9607f upload page updated,minor changes in attendance page.
    * 270327b added attendance page
    * ad9c33f php files for upload page
    * 0f8bb8d php files
    
    
