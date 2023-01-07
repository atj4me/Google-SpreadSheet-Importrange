h1. IMPORTRANGE function generator tool

For some specific purpose, like when creating a proposal in Google Sheet, we always needed to use IMPORTTANGE to make a copy available to other users, while not revealing the internal calculations. 

This script is created exactly for that. 

To run it, clone it into a folder using git clone 

```
git clone https://github.com/atj4me/Google-SpreadSheet-Importrange.git
```

or extract the downloadable zip into a folder. 

Open a terminal and change the current working directory to my folder. 

Once there, you can simply run the command

```
php generate.php
```

and it will ask the SpreadSheet URL, The rows to fetch and the name of the sheet. 

Once entered, it will generate the functions that can be pasted in the spreadsheet to get the values from the original spreadsheet