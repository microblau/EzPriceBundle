<?php /* #?ini charset="utf-8"?

[ImageMagick]
Name=ImageMagick
# If set to true then this handler will be used,
# The setup wizard will turn this off it ImageMagick is not found on the system
IsEnabled=true
# Which PHP handler to use for the conversion,
# ezimageshell means to use the generic shell handler which
# creates a command line and executes it with system().
Handler=eZImageShellFactory
# The path to the executable, can be empty for global path.
ExecutablePath=C:\Program Files\ImageMagick-6.7.4-Q16
# Name of the executable
Executable=convert.exe
# Name of the executable for windows,
# uncomment ExecutableMac for Mac specific converter and
# ExecutableUnix for Unix/Linux specific converter

# ExecutableMac=convert
# ExecutableUnix=convert
# Parameters that must be run before the filenames and filters.
PreParameters=
# Parameters that must be run after the filenames and filters.
PostParameters=
# Whether the destination name should be prefixed with a TAG name (see MIMETagMap below)
# The variable contains the separator between the TAG and the filename.
# This is needed for ImageMagick to provide proper conversions of some formats.
UseTypeTag=:


*/ ?>
