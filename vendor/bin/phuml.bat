@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../phuml/phuml/bin/phuml
php "%BIN_TARGET%" %*
