# didya

Suggestions for uh-ohs in PHP - detects mispelled symbols (functions, methods, variable names) inspired by ["Did you mean?" Experience in Ruby](http://www.yukinishijima.net/2014/10/21/did-you-mean-experience-in-ruby.html) by Yuki Nishijima.

**DANGER DANGER**: This is a proof of concept, which should only be used in development. If this is *not* in your Composer `require-dev`, you're asking for trouble. It also does some ~\~magic~\~ under the covers, which you may want to read about at the end of this README.

----

### Magic

Basically, to ensure `didya` can be used in a large number of different scenarios,
it uses reflection to mess with the `Exception` it captures, and change its message.

### License and author

Didya is primarily developed by [Filipe Dobreira](https://github.com/filp), and
distributed under the MIT license.

See the LICENSE.md file for additional information.
