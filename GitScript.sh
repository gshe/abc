#!/bin/bash
git status
git pull --rebase
git add .
git commit -am "new email"
git push