#!/usr/bin/perl
#
package tester;

use Moose;
use Dancer:moose;

get '/hello/:name' => sub {
	return "Ello ello ello " . params->{name};
};

dance;

