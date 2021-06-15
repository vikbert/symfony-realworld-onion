# Model
Model consists of the entities, value objects, aggregates.

# CQRS
CQRS stands for Command Query Responsibility Segregation. It's a pattern described by Greg Young.
At its heart is the notion that you can use a different model to update information than the model you use for reading
information. For some situations, this separation can be valuable, but beware that for most systems CQRS adds
risky complexity.

# DTO
When you're working with a remote interface, you need to transfer more data with each call. 
The solution is to create a Data Transfer Object that can hold all the data for the call. 
It needs to be serializable to go across the connection. Usually an assembler is used on the server side to transfer 
data between the DTO  and any domain objects.

it's worth mentioning that another advantage is to encapsulate the serialization mechanism for transferring data over 
the wire. By encapsulating the serialization like this, the DTOs keep this logic out of the rest of the code and also 
provide a clear point to change serialization should you wish.

