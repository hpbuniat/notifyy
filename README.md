notifyy - simple notification library
=====

notifyy is a re-usable component to do easy notifying, e.g. for status reports or updates.
This is especially useful in cli applications where it's not longer necessary to continuously monitor the jobs output or to tail a log-file.

Builtin Notifiers
-----

- Stdout (simply prints the output)
- File
- Dbus
- Growl (works well with snarl on windows)
- Libnotify (uses notify-send)

Extending
-----
You may add own adapters by simply implementing the Notifyable-Interface.