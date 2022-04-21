# Storage Service

@todo its late and there's a probably a better place to put this but just dumping some intentions...

There may be cleaner more extendable ways of implementing this, however the purpose of the Storage Service for now is
to allow for a feature file, for example, to uniquely identify a resource in a step like so:

`Given a resource exists`

`Given resource a exists`

`Given resource 1 exists`

These will then get stored in the storage container respectively:

`resource => Resource`

`resource.a => Resource`

`resource.1 => Resource`

Contexts can then use transformations to retrieve a resource from storage by the identifier and inject them.