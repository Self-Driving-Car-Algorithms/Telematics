# Telematics: An open-source vehicle & fleet tracking application

## The why:
### For a good few years, I've been glancing at [OASA](http://telematics.oasa.gr)'s Telematics system, and I've been wondering, "why's it so shit? no public API, most probably vulnerable as fuck.."
I've decided to change that. gtsatsis/Telematics is an open-source attempt at a software pitch to OASA.

I'm doing this mostly as a sideproject for the fun of it, but I would also love it if they used this in the future, once it's stable and usable.

## The how:
By utilizing PHP-FPM, along with NGINX, I believe that this can be a way more stable solution to OASA's current systen (which, at the time of writing, has had timeouts at 7:40-8:00AM for 3 consecutive days).

The database used is Postgres, and my plan is to add support for a Redis caching server to be used alongside this.

## Current status of the project:
Currently, this is in *very* early development, and it has not been tested with **any** test cases.

This is currently a singlehandedly developed solution, so I'd expect this to be quite slow in being developed.

## Roadmap:
* Create a proper vehicle management API endpoint
* Create a proper route management API endpoint
* Create a proper authorization credential provisioning API endpoint
* Stress test under base [OASA](http://oasa.gr) conditions (~2-20 million requests per minute? [Citation needed])
* Create a *basic* front-end to the application
* Create a *basic* companion Android application as a demo

## Notice:

This project is in no way, shape, or form affiliated with OASA, or any of its subsidiaries, they're simply my motivation in order to create this.
