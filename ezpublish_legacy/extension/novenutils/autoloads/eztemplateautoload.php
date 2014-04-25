<?php
// SOFTWARE NAME: Noven Utils
// SOFTWARE RELEASE: 1.0
// COPYRIGHT NOTICE: Copyright (C) 1999-2009 Noven
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.

// Operator autoloading
$eZTemplateOperatorArray = array();

// String Utilities
$eZTemplateOperatorArray[] =
  array( 'script' => 'extension/novenutils/autoloads/novenstringutilities.php',
         'class' => 'NovenStringUtilities',
         'operator_names' => array( 'escape_as_entities', 
         							'shorten_to_last_word', 
         							'split_words_in_parts' ));

// Various utilities
$eZTemplateOperatorArray[] =
  array( 'script' => 'extension/novenutils/autoloads/novenmiscutilities.php',
         'class' => 'NovenMiscUtilities',
         'operator_names' => array( 'persistent_variable_append',
  									'server_variable',
  									'session_set',
  									'media_url' ));