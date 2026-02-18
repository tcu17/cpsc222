#!/usr/bin/perl

my $sudoCount = 0;

my $logFile = "/var/log/auth.log";

open (my $file, "<", $logFile) or exit 1;

while (my $line = <$file>)
{
	if ($line =~ /sudo:.*session opened/)
	{
		$sudoCount++;
	}
}

close($file);

print $sudoCount;
