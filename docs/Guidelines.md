# Getters on Aggregates

Getter are fine. The case of "don't write getters" is to avoid exposing internal state outside the aggregate: when your services take the aggregate, fetch its state, and make some decision based on that. That's what you want to avoid.

You could follow the guideline of the Law of Demeter, and aim for that. Don't strictly avoid getter, but be mindful about them.

Having a getId or getUsername is perfectly fine. Having a getCollection-kind of method that returns a mutable collection is not. The aggregate lose control on what it's an internal details, an implementation details. When you expose something like getFriends(), your services could call it, add or delete things outside the aggregate, and you basically lose the ability refactor the aggregate without breaking everything. an addFriend() and deleteFriend() in that case would solve it. And if getFriends() returns an immutable collection, it's fine as well.

Don't write getters is not an hard rule, try not to expose too much state outside the aggregate, but don't unnecessarily complicate your life by not have any getters at all. Use them if it make sense.
