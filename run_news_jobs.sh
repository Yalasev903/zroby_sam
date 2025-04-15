#!/bin/bash

PHP="/usr/bin/php"
ARTISAN="/var/www/zroby_sam/artisan"

echo "=== [START] Fetching news ==="
$PHP $ARTISAN news:fetch >> /var/www/zroby_sam/storage/logs/news_fetch.log 2>&1

echo "=== [RUN] Optimizing news ==="
$PHP $ARTISAN news:optimize >> /var/www/zroby_sam/storage/logs/news_optimize.log 2>&1
