# phunky

*punky* delivers a rich collection of general-purpose functions, which help reduce the amount of stateful, verbose and frankly inelegant code that emerges spontaneously in PHP. 

Most of these utilities are inspired by Clojure's wonderful standard library, and adapted to respect PHP's own sensibilities, idioms and limitations.

## Warning

This is a pre-alpha proof of concept. It's undocumented and untested. The API may, and will change.

## On performance

Due to its methodology, *phunky* will inherently incur a certain performance cost. Measures are taken to minimise this footprint, but it's not the project's top priority.

Since PHP does not offer any form of persistent data structures, *phunky* tries to compensate by employing stateful/effectful operations, but does so in isolation.
